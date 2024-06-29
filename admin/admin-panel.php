<?php
session_start();
include '../Assets/php/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../index.html");
    exit();
}
    // $stmt = $conn->prepare("SELECT id username FROM users WHERE verification_code = ?");
    // $stmt->bind_param("s", $code);
    // $stmt->execute();
    // $stmt->store_result();
    // if($stmt->num_rows > 0) {
    //     $stmt->bind_result($username);
    //     $stmt->fetch();
    // }
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth focus:scroll-auto">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Deadly Air</title>

    <script async src="https://js.stripe.com/v3/buy-button.js"></script>

    <link rel="stylesheet" href="../Assets/css/styles.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../Assets/js/tailwind.config.js"></script>
    <script>
      function formatDate(date) {
        // Récupérer le jour, le mois et l'année
        let day = date.getDate();
        let month = date.getMonth() + 1; // Les mois commencent à 0
        let year = date.getFullYear() % 100; // Obtenir les deux derniers chiffres de l'année

        // Ajouter un zéro devant le jour et le mois s'ils sont inférieurs à 10
        day = day < 10 ? "0" + day : day;
        month = month < 10 ? "0" + month : month;
        year = year < 10 ? "0" + year : year;

        // Retourner la date formatée
        return `${day}/${month}/${year}`;
      }

      // Exemple d'utilisation
      let today = new Date();
    </script>
  </head>
  <body class="overflow-x-hidden">
    <nav
      class="z-[10000] fixed top-0 left-0 flex justify-between items-center w-full h-20 px-12 py-2.5 bg-trans70"
    >
      <a href="#" class="flex justify-between items-center px-10 h-full gap-16">
        <img
          src="Assets/Media/Logo.webp"
          alt="logo"
          class="object-cover h-12 w-12 rounded-xl"
        />
        <h2 class="font-roadrage text-4xl">Deadly Air</h2>
      </a>
      <div class="flex justify-between items-center h-full gap-16 text-xl">
        <a href="index.html#">Accueil</a><a href="#BlogEditor">Blog ✏️</a>
      </div>
    </nav>
    <section
      class="relative flex flex-col justify-center items-center bg-gris w-full h-screen"
    >
      <video
        class="absolute z-0 w-full h-full object-cover"
        autoplay
        loop
        muted
      >
        <source
          id="video-bg-src"
          src="http://88.127.116.195:16384/Deadly-Air/bg-vid.mp4"
          type="video/mp4"
        />
      </video>
      <!-- <img
        src="Assets/Media/SupermanGap.png"
        alt="SupermanGap"
        class="absolute z-0 w-full h-full object-cover"
      /> -->
      <!--On met une photo car la vidéo est trop gourmande pour github -->
      <h1
        class="z-10 text-9xl font-roadrage text-transparent bg-clip-text border-solid text-stroke-3 select-none"
      >
        Admin Panel <?php echo $username ?>
      </h1>
      <input
        id="url-bg-vid-input"
        type="text"
        value=""
        class="z-10 w-96 text-center font-oswald_light text-noir border-2 border-vert-1 backdrop-blur-lg p-4 rounded-lg bg-trans70"
      />
    </section>
    <script>
      const UrlBgVidInput = document.getElementById("url-bg-vid-input");
      const videoBgSrc = document.getElementById("video-bg-src");
      console.log(videoBgSrc);
      console.log(videoBgSrc.src);
      UrlBgVidInput.value = videoBgSrc.src;
      console.log(UrlBgVidInput.value);

      UrlBgVidInput.addEventListener("input", function () {});
    </script>

    <section
      id="BlogEditor"
      class="flex flex-col items-center justify-around min-h-screen mb-4"
    >
      <header class="flex justify-between items-center px-8 py-2.5 h-20 w-full">
        <h2 class="font-roadrage text-6xl">Blog Editor</h2>
        <i class="text-vert-1 text-xl"></i>
      </header>
      <div class="flex text-blanc w-full min-h-fit">
        <div class="flex flex-wrap gap-8 justify-around px-12 h w-full">
          <article
            class="flex flex-col bg-gris border-4 border-noir rounded-lg px-4 py-2.5 max-w-96 min-w-80"
          >
            <div
              id="image-drop-area"
              class="rounded-lg h-2/4 flex items-center justify-center border-dashed border-2 border-vert-1 p-2"
              style="position: relative"
            >
              <input
                type="file"
                id="image-input"
                accept="image/*"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
              />
              <p
                id="image-placeholder"
                class="text-gray-500 font-oswald_extralight text-center"
              >
                Glissez-déposez une image ou cliquez pour choisir un fichier
              </p>
            </div>
            <div class="h-2/4">
              <h4 class="py-2.5 font-oswald_bold text-end">
                <input
                  id="titre-blog-input"
                  type="text"
                  value=""
                  placeholder="Titre Blog"
                  class="text-blanc font-oswald_light text-noir border-2 h-8 border-vert-1 backdrop-blur-lg p-4 rounded-lg bg-transparent"
                />
              </h4>
              <textarea
                name="blog-content"
                id="blog-content-textarea"
                placeholder="Bio du blog"
                class="font-oswald_extralight w-full resize-none text-blanc font-oswald_light text-noir border-2 border-vert-1 backdrop-blur-lg px-2 rounded-lg bg-transparent"
                style="height: calc(100% - 50px)"
              ></textarea>
              <script>
                const TitreBlogInput =
                  document.getElementById("titre-blog-input");
                const BlogContentTextarea = document.getElementById(
                  "blog-content-textarea"
                );
              </script>
            </div>
            <footer class="flex justify-between items-center py-4 px-2.5">
              <div>
                <script>
                  document.write(formatDate(today));
                </script>
              </div>
              <button
                class="flex justify-between items-center p-4 bg-noir rounded-lg"
              >
                <div>Value |</div>
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g clip-path="url(#clip0_45_506)">
                    <path
                      d="M11.08 0.0576053C9.885 -0.241145 8.775 0.662605 8.695 1.83261C8.605 3.14636 8.4075 4.35261 8.16 5.07011C8.00375 5.52011 7.56125 6.33636 6.86 7.11886C6.16375 7.89761 5.2575 8.59136 4.19625 8.88136C3.35625 9.11011 2.5 9.83761 2.5 10.9001V15.9014C2.5 16.9576 3.3525 17.7314 4.31 17.8326C5.6475 17.9751 6.265 18.3514 6.895 18.7364L6.955 18.7739C7.295 18.9801 7.6775 19.2089 8.1675 19.3789C8.66375 19.5489 9.24375 19.6501 10 19.6501H14.375C15.5462 19.6501 16.3738 19.0539 16.7925 18.3201C16.9949 17.9739 17.1043 17.5811 17.11 17.1801C17.11 16.9901 17.0813 16.7901 17.0138 16.6001C17.265 16.2714 17.4887 15.8776 17.6237 15.4739C17.7612 15.0614 17.8387 14.5214 17.6287 14.0376C17.715 13.8751 17.7788 13.7014 17.8275 13.5339C17.9238 13.1964 17.9688 12.8239 17.9688 12.4626C17.9688 12.1026 17.9238 11.7314 17.8275 11.3926C17.7848 11.2365 17.727 11.085 17.655 10.9401C17.8739 10.6287 18.0147 10.2692 18.0656 9.89203C18.1165 9.51482 18.076 9.13089 17.9475 8.77261C17.69 8.03261 17.095 7.39761 16.4475 7.18261C15.3887 6.83011 14.1938 6.83761 13.3025 6.91886C13.1175 6.93557 12.9328 6.95641 12.7488 6.98136C13.1806 5.12415 13.154 3.18974 12.6713 1.34511C12.587 1.04959 12.4252 0.781962 12.2028 0.569892C11.9804 0.357823 11.7054 0.209014 11.4062 0.138855L11.08 0.0576053ZM14.375 18.4014H10C9.3625 18.4014 8.92125 18.3151 8.575 18.1964C8.22375 18.0751 7.9425 17.9114 7.605 17.7051L7.555 17.6751C6.86125 17.2514 6.0575 16.7614 4.4425 16.5901C4.02625 16.5451 3.75 16.2276 3.75 15.9026V10.9001C3.75 10.5826 4.0325 10.2214 4.525 10.0876C5.89375 9.7126 6.99625 8.84261 7.7925 7.95261C8.58625 7.06511 9.1225 6.10886 9.34 5.48011C9.64375 4.60511 9.84875 3.27011 9.9425 1.91761C9.97375 1.46511 10.3925 1.17511 10.7763 1.27011L11.1038 1.35261C11.3038 1.40261 11.4262 1.53136 11.4637 1.67136C11.9742 3.61638 11.9113 5.66754 11.2825 7.57761C11.2469 7.68384 11.2405 7.79769 11.264 7.90723C11.2875 8.01678 11.34 8.11799 11.4161 8.20028C11.4921 8.28257 11.5888 8.34292 11.6962 8.37499C11.8035 8.40707 11.9175 8.4097 12.0263 8.38261L12.03 8.38136L12.0475 8.37761L12.12 8.36011C12.5475 8.26959 12.9799 8.20407 13.415 8.16386C14.2438 8.08886 15.2363 8.09636 16.0525 8.36886C16.2713 8.44136 16.615 8.74386 16.765 9.18136C16.8987 9.56636 16.8737 10.0189 16.4325 10.4589L15.9913 10.9001L16.4325 11.3426C16.4862 11.3964 16.5638 11.5189 16.625 11.7364C16.685 11.9451 16.7188 12.1989 16.7188 12.4626C16.7188 12.7276 16.685 12.9801 16.625 13.1901C16.5625 13.4076 16.4862 13.5301 16.4325 13.5839L15.9913 14.0251L16.4325 14.4676C16.4912 14.5264 16.5688 14.6889 16.4388 15.0776C16.3042 15.455 16.0887 15.7984 15.8075 16.0839L15.3663 16.5251L15.8075 16.9676C15.815 16.9739 15.8588 17.0301 15.8588 17.1801C15.8514 17.3632 15.7995 17.5417 15.7075 17.7001C15.5012 18.0601 15.0788 18.4014 14.375 18.4014Z"
                      fill="white"
                    />
                  </g>
                  <defs>
                    <clipPath id="clip0_45_506">
                      <rect width="20" height="20" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
              </button>
            </footer>
          </article>
          <article
            class="flex flex-col bg-gris border-4 border-noir rounded-lg px-4 py-2.5 max-w-96 min-w-80"
          >
            <div class="h-2/4">
              <img
                id="image-preview"
                src="Assets/Media/Logo.webp"
                alt="Image Blog"
                class="rounded-lg h-full w-full object-cover"
              />
            </div>
            <div class="h-2/4">
              <h4 id="titre-blog" class="py-2.5 font-oswald_bold text-end"></h4>
              <script>
                let TitreBlog = document.getElementById("titre-blog");

                TitreBlogInput.addEventListener("input", () => {
                  console.log(TitreBlogInput.value);
                  TitreBlog.innerHTML = TitreBlogInput.value;
                });
              </script>
              <p id="desc-blog" class="font-oswald_extralight"></p>
              <script>
                let DescBlog = document.getElementById("desc-blog");
                console.log(BlogContentTextarea);
                BlogContentTextarea.addEventListener("input", () => {
                  console.log(BlogContentTextarea.value);
                  DescBlog.innerHTML = BlogContentTextarea.value;
                });
              </script>
            </div>
            <footer class="flex justify-between items-center py-4 px-2.5">
              <div>
                <script>
                  document.write(formatDate(today));
                </script>
              </div>
              <button
                class="flex justify-between items-center p-4 bg-noir rounded-lg"
              >
                <div>Value |</div>
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g clip-path="url(#clip0_45_506)">
                    <path
                      d="M11.08 0.0576053C9.885 -0.241145 8.775 0.662605 8.695 1.83261C8.605 3.14636 8.4075 4.35261 8.16 5.07011C8.00375 5.52011 7.56125 6.33636 6.86 7.11886C6.16375 7.89761 5.2575 8.59136 4.19625 8.88136C3.35625 9.11011 2.5 9.83761 2.5 10.9001V15.9014C2.5 16.9576 3.3525 17.7314 4.31 17.8326C5.6475 17.9751 6.265 18.3514 6.895 18.7364L6.955 18.7739C7.295 18.9801 7.6775 19.2089 8.1675 19.3789C8.66375 19.5489 9.24375 19.6501 10 19.6501H14.375C15.5462 19.6501 16.3738 19.0539 16.7925 18.3201C16.9949 17.9739 17.1043 17.5811 17.11 17.1801C17.11 16.9901 17.0813 16.7901 17.0138 16.6001C17.265 16.2714 17.4887 15.8776 17.6237 15.4739C17.7612 15.0614 17.8387 14.5214 17.6287 14.0376C17.715 13.8751 17.7788 13.7014 17.8275 13.5339C17.9238 13.1964 17.9688 12.8239 17.9688 12.4626C17.9688 12.1026 17.9238 11.7314 17.8275 11.3926C17.7848 11.2365 17.727 11.085 17.655 10.9401C17.8739 10.6287 18.0147 10.2692 18.0656 9.89203C18.1165 9.51482 18.076 9.13089 17.9475 8.77261C17.69 8.03261 17.095 7.39761 16.4475 7.18261C15.3887 6.83011 14.1938 6.83761 13.3025 6.91886C13.1175 6.93557 12.9328 6.95641 12.7488 6.98136C13.1806 5.12415 13.154 3.18974 12.6713 1.34511C12.587 1.04959 12.4252 0.781962 12.2028 0.569892C11.9804 0.357823 11.7054 0.209014 11.4062 0.138855L11.08 0.0576053ZM14.375 18.4014H10C9.3625 18.4014 8.92125 18.3151 8.575 18.1964C8.22375 18.0751 7.9425 17.9114 7.605 17.7051L7.555 17.6751C6.86125 17.2514 6.0575 16.7614 4.4425 16.5901C4.02625 16.5451 3.75 16.2276 3.75 15.9026V10.9001C3.75 10.5826 4.0325 10.2214 4.525 10.0876C5.89375 9.7126 6.99625 8.84261 7.7925 7.95261C8.58625 7.06511 9.1225 6.10886 9.34 5.48011C9.64375 4.60511 9.84875 3.27011 9.9425 1.91761C9.97375 1.46511 10.3925 1.17511 10.7763 1.27011L11.1038 1.35261C11.3038 1.40261 11.4262 1.53136 11.4637 1.67136C11.9742 3.61638 11.9113 5.66754 11.2825 7.57761C11.2469 7.68384 11.2405 7.79769 11.264 7.90723C11.2875 8.01678 11.34 8.11799 11.4161 8.20028C11.4921 8.28257 11.5888 8.34292 11.6962 8.37499C11.8035 8.40707 11.9175 8.4097 12.0263 8.38261L12.03 8.38136L12.0475 8.37761L12.12 8.36011C12.5475 8.26959 12.9799 8.20407 13.415 8.16386C14.2438 8.08886 15.2363 8.09636 16.0525 8.36886C16.2713 8.44136 16.615 8.74386 16.765 9.18136C16.8987 9.56636 16.8737 10.0189 16.4325 10.4589L15.9913 10.9001L16.4325 11.3426C16.4862 11.3964 16.5638 11.5189 16.625 11.7364C16.685 11.9451 16.7188 12.1989 16.7188 12.4626C16.7188 12.7276 16.685 12.9801 16.625 13.1901C16.5625 13.4076 16.4862 13.5301 16.4325 13.5839L15.9913 14.0251L16.4325 14.4676C16.4912 14.5264 16.5688 14.6889 16.4388 15.0776C16.3042 15.455 16.0887 15.7984 15.8075 16.0839L15.3663 16.5251L15.8075 16.9676C15.815 16.9739 15.8588 17.0301 15.8588 17.1801C15.8514 17.3632 15.7995 17.5417 15.7075 17.7001C15.5012 18.0601 15.0788 18.4014 14.375 18.4014Z"
                      fill="white"
                    />
                  </g>
                  <defs>
                    <clipPath id="clip0_45_506">
                      <rect width="20" height="20" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
              </button>
            </footer>
          </article>

          <script>
            const imageInput = document.getElementById("image-input");
            const imageDropArea = document.getElementById("image-drop-area");
            const imagePreview = document.getElementById("image-preview");
            const imagePlaceholder =
              document.getElementById("image-placeholder");

            imageInput.addEventListener("change", (event) => {
              handleFile(event.target.files[0]);
            });

            imageDropArea.addEventListener("dragover", (event) => {
              event.preventDefault();
              imageDropArea.classList.add("border-vert-2");
            });

            imageDropArea.addEventListener("dragleave", () => {
              imageDropArea.classList.remove("border-vert-2");
            });

            imageDropArea.addEventListener("drop", (event) => {
              event.preventDefault();
              imageDropArea.classList.remove("border-vert-2");
              if (event.dataTransfer.files.length) {
                handleFile(event.dataTransfer.files[0]);
              }
            });

            function handleFile(file) {
              if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = (event) => {
                  imagePreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
              } else {
                alert("Please drop a valid image file.");
              }
            }
          </script>
        </div>
      </div>
    </section>
  </body>
</html>
