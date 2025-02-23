<?php
session_start();
include 'Assets/php/config.php';
$stmt = $conn->prepare("SELECT id, title, content, image_path, created_at, likes FROM blogs");
    $stmt->execute();

    $result = $stmt->get_result();
    $blogs = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth focus:scroll-auto">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Deadly Air</title>
    <link rel="icon" href="Assets/Media/Logo.webp" type="image/icon type">

    <script async src="https://js.stripe.com/v3/buy-button.js"></script>

    <link rel="stylesheet" href="Assets/css/styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="Assets/js/tailwind.config.js"></script>
</head>

<body class="flex flex-col items-center overflow-x-hidden">
    <nav class="z-[10000] fixed top-0 left-0 flex justify-between items-center w-full h-20 px-12 py-2.5 bg-trans70 max-sm:px-2">
        <a href="#" class="flex justify-between items-center h-full gap-16 max-lg:gap-4 max-sm:text-base max-sm:gap-2">
            <img src="Assets/Media/Logo.webp" alt="logo" class="object-cover h-12 w-12 rounded-xl max-sm:w-8 max-sm:h-8">
            <h2 class="font-roadrage text-4xl max-sm:text-2xl max-xs:text-xl">Deadly Air</h2>
        </a>
        <div class="flex justify-between items-center h-full gap-16 text-xl max-lg:gap-4 max-sm:text-sm"><a href="#Apropos">À Propos</a><a
                href="#Blog">Blog</a><a href="#Boutique">Boutique</a><a href="#Contact">Contact</a></div>
    </nav>
    <section
      class="relative flex justify-center items-center bg-gris w-full h-screen max-lg:h-[75vh]"
    >
      <video id="background-video" class="absolute z-0 w-full h-full object-cover" autoplay loop muted>
          <source src="http://88.127.116.195/Deadly-Air/bg-vid.mp4" type="video/mp4">    
      </video>
      <!--On met une photo car la vidéo est trop gourmande pour github -->
      <h1
        class="z-10 text-9xl font-roadrage text-transparent bg-clip-text border-solid text-stroke-3 select-none text-center px-8 max-sm:text-6xl max-sm:text-stroke-2 max-sm:"
      >
        Vivez l'adrénaline avec Deadly Air
      </h1>
      <div class="absolute bottom-2.5 left-2.5 flex gap-4">
        <button id="mute-toggle" class="flex items-center justify-center w-12 h-12 bg-trans70 rounded-full"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.7925 8.875C17.0043 8.97702 17.183 9.13669 17.3081 9.33569C17.4333 9.53468 17.4998 9.76493 17.5 10V30C17.4997 30.2352 17.433 30.4656 17.3076 30.6646C17.1822 30.8636 17.0032 31.0232 16.7912 31.125C16.5792 31.2268 16.3427 31.2668 16.109 31.2402C15.8753 31.2137 15.6538 31.1218 15.47 30.975L9.5625 26.25H3.75C3.41848 26.25 3.10054 26.1183 2.86612 25.8839C2.6317 25.6495 2.5 25.3315 2.5 25V15C2.5 14.6685 2.6317 14.3505 2.86612 14.1161C3.10054 13.8817 3.41848 13.75 3.75 13.75H9.5625L15.47 9.025C15.6539 8.87797 15.8757 8.78588 16.1096 8.75935C16.3436 8.73281 16.5803 8.7729 16.7925 8.875ZM34.635 14.115C34.7514 14.2311 34.8438 14.3691 34.9068 14.5209C34.9698 14.6728 35.0022 14.8356 35.0022 15C35.0022 15.1644 34.9698 15.3272 34.9068 15.4791C34.8438 15.6309 34.7514 15.7689 34.635 15.885L30.5175 20L34.635 24.115C34.8697 24.3497 35.0016 24.6681 35.0016 25C35.0016 25.3319 34.8697 25.6503 34.635 25.885C34.4003 26.1197 34.0819 26.2516 33.75 26.2516C33.4181 26.2516 33.0997 26.1197 32.865 25.885L28.75 21.7675L24.635 25.885C24.4003 26.1197 24.0819 26.2516 23.75 26.2516C23.4181 26.2516 23.0997 26.1197 22.865 25.885C22.6303 25.6503 22.4984 25.3319 22.4984 25C22.4984 24.6681 22.6303 24.3497 22.865 24.115L26.9825 20L22.865 15.885C22.7488 15.7688 22.6566 15.6308 22.5937 15.479C22.5308 15.3271 22.4984 15.1644 22.4984 15C22.4984 14.8356 22.5308 14.6729 22.5937 14.521C22.6566 14.3692 22.7488 14.2312 22.865 14.115C23.0997 13.8803 23.4181 13.7484 23.75 13.7484C23.9144 13.7484 24.0771 13.7808 24.229 13.8437C24.3808 13.9066 24.5188 13.9988 24.635 14.115L28.75 18.2325L32.865 14.115C32.9811 13.9986 33.1191 13.9062 33.2709 13.8432C33.4228 13.7802 33.5856 13.7478 33.75 13.7478C33.9144 13.7478 34.0772 13.7802 34.2291 13.8432C34.3809 13.9062 34.5189 13.9986 34.635 14.115Z" fill="black"/></svg></button>
        <input id="volume-control" class="bg-trans70 rounded-sm cursor-pointer" type="range" min="0" max="100" value="10">
      </div>
    </section>
    <script>
        const video = document.getElementById('background-video');
        const muteToggle = document.getElementById('mute-toggle');
        const volumeControl = document.getElementById('volume-control');
        volumeControl.style.display = 'none';
      
        muteToggle.addEventListener('click', () => {
          if (video.muted) {
            video.muted = false;
            volumeControl.style.display = 'block';
            muteToggle.innerHTML = '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28.8403 35.025C30.8169 33.0544 32.3845 30.7125 33.4528 28.134C34.5211 25.5554 35.0691 22.7911 35.0653 20C35.0691 17.2089 34.5211 14.4446 33.4528 11.866C32.3845 9.28749 30.8169 6.94558 28.8403 4.97501L27.0703 6.74251C28.8137 8.48181 30.1963 10.5483 31.1389 12.8234C32.0814 15.0985 32.5653 17.5374 32.5628 20C32.5628 25.1775 30.4628 29.865 27.0703 33.2575L28.8403 35.025Z" fill="black"/><path d="M25.3027 31.49C26.8139 29.9828 28.0123 28.1918 28.8292 26.22C29.6461 24.2482 30.0653 22.1343 30.0627 20C30.0653 17.8657 29.6461 15.7519 28.8292 13.78C28.0123 11.8082 26.8139 10.0172 25.3027 8.51001L23.5352 10.2775C24.8142 11.5526 25.8285 13.0681 26.5197 14.7366C27.2109 16.4052 27.5653 18.194 27.5627 20C27.566 21.8063 27.2121 23.5954 26.5213 25.2645C25.8305 26.9335 24.8165 28.4494 23.5377 29.725L25.3027 31.49Z" fill="black"/><path d="M21.7675 27.955C22.8122 26.9103 23.6408 25.6701 24.2062 24.3052C24.7715 22.9403 25.0625 21.4774 25.0625 20C25.0625 18.5226 24.7715 17.0597 24.2062 15.6948C23.6408 14.3299 22.8122 13.0897 21.7675 12.045L20 13.8125C20.8125 14.6251 21.457 15.5897 21.8967 16.6514C22.3363 17.713 22.5626 18.8509 22.5625 20C22.5626 21.1491 22.3363 22.287 21.8967 23.3486C21.457 24.4103 20.8125 25.3749 20 26.1875L21.7675 27.955ZM16.7925 8.87499C17.0043 8.97701 17.183 9.13669 17.3081 9.33568C17.4333 9.53467 17.4998 9.76492 17.5 9.99999V30C17.4997 30.2352 17.433 30.4656 17.3076 30.6646C17.1822 30.8636 17.0032 31.0232 16.7912 31.125C16.5792 31.2268 16.3427 31.2668 16.109 31.2402C15.8753 31.2137 15.6538 31.1218 15.47 30.975L9.5625 26.25H3.75C3.41848 26.25 3.10054 26.1183 2.86612 25.8839C2.6317 25.6495 2.5 25.3315 2.5 25V15C2.5 14.6685 2.6317 14.3505 2.86612 14.1161C3.10054 13.8817 3.41848 13.75 3.75 13.75H9.5625L15.47 9.02499C15.6539 8.87796 15.8757 8.78588 16.1096 8.75934C16.3436 8.7328 16.5803 8.77289 16.7925 8.87499Z" fill="black"/></svg>';
          } else {
            video.muted = true;
            volumeControl.style.display = 'none';
            muteToggle.innerHTML = '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.7925 8.875C17.0043 8.97702 17.183 9.13669 17.3081 9.33569C17.4333 9.53468 17.4998 9.76493 17.5 10V30C17.4997 30.2352 17.433 30.4656 17.3076 30.6646C17.1822 30.8636 17.0032 31.0232 16.7912 31.125C16.5792 31.2268 16.3427 31.2668 16.109 31.2402C15.8753 31.2137 15.6538 31.1218 15.47 30.975L9.5625 26.25H3.75C3.41848 26.25 3.10054 26.1183 2.86612 25.8839C2.6317 25.6495 2.5 25.3315 2.5 25V15C2.5 14.6685 2.6317 14.3505 2.86612 14.1161C3.10054 13.8817 3.41848 13.75 3.75 13.75H9.5625L15.47 9.025C15.6539 8.87797 15.8757 8.78588 16.1096 8.75935C16.3436 8.73281 16.5803 8.7729 16.7925 8.875ZM34.635 14.115C34.7514 14.2311 34.8438 14.3691 34.9068 14.5209C34.9698 14.6728 35.0022 14.8356 35.0022 15C35.0022 15.1644 34.9698 15.3272 34.9068 15.4791C34.8438 15.6309 34.7514 15.7689 34.635 15.885L30.5175 20L34.635 24.115C34.8697 24.3497 35.0016 24.6681 35.0016 25C35.0016 25.3319 34.8697 25.6503 34.635 25.885C34.4003 26.1197 34.0819 26.2516 33.75 26.2516C33.4181 26.2516 33.0997 26.1197 32.865 25.885L28.75 21.7675L24.635 25.885C24.4003 26.1197 24.0819 26.2516 23.75 26.2516C23.4181 26.2516 23.0997 26.1197 22.865 25.885C22.6303 25.6503 22.4984 25.3319 22.4984 25C22.4984 24.6681 22.6303 24.3497 22.865 24.115L26.9825 20L22.865 15.885C22.7488 15.7688 22.6566 15.6308 22.5937 15.479C22.5308 15.3271 22.4984 15.1644 22.4984 15C22.4984 14.8356 22.5308 14.6729 22.5937 14.521C22.6566 14.3692 22.7488 14.2312 22.865 14.115C23.0997 13.8803 23.4181 13.7484 23.75 13.7484C23.9144 13.7484 24.0771 13.7808 24.229 13.8437C24.3808 13.9066 24.5188 13.9988 24.635 14.115L28.75 18.2325L32.865 14.115C32.9811 13.9986 33.1191 13.9062 33.2709 13.8432C33.4228 13.7802 33.5856 13.7478 33.75 13.7478C33.9144 13.7478 34.0772 13.7802 34.2291 13.8432C34.3809 13.9062 34.5189 13.9986 34.635 14.115Z" fill="black"/></svg>';
          }
        });
      
        volumeControl.addEventListener('input', () => {
          video.volume = volumeControl.value / 100;
        });
      
        // Set initial volume
        video.volume = volumeControl.value / 100;
      </script>

    <section id="Apropos" class="container flex flex-col h-auto pt-16 px-4 min-h-screen">
        <header class="flex justify-between items-center gap-16 px-8 py-2.5 h-20 w-full max-sm:gap-2">
            <h2 class="font-roadrage text-6xl max-sm:text-4xl">À Propos</h2>
            <i class="text-vert-2 text-xl text-end max-lg:text-base max-lg:font-oswald_light max-sm:font-oswald_extralight max-sm:text-xs">— Vivre pour rouler, rouler pour vivre.</i>
        </header>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <article id="#A1" class="relative gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-lg:h-fit max-lg:min-h-full">
                <div class="flex justify-end w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg w-fit text-right font-oswald_bold text-xl max-sm:text-base max-sm:font-oswald_medium">Origine du Groupe</h4>
                </div>
                <p class="font-oswald_extralight text-base max-lg:font-sm max-sm:font-xs max-sm:font-oswald_extralight">Deadly Air a été fondé en mai 2024 par Cuic, qui a invité ses amis à créer un groupe de MTB dirt. <br> Notre aventure a commencé avec une passion commune pour le dirt biking et l'envie de partager cette passion avec le monde entier. <br> Cuic, notre fondateur principal, a toujours rêvé de capturer et de diffuser des vidéos de haute qualité qui émerveillent et inspirent la communauté du MTB dirt.</p>
            </article>
            <article id="#A2" class="relative bg-[url(Assets/Media/Wipe.png)] bg-cover bg-repeat bg-center gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-sm:hidden">
                <div class="flex justify-end w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg backdrop-blur-lg  w-fit text-right font-oswald_bold text-xl">26/06/24</h4>
                </div>
            </article>
            <article id="#A3" class="relative gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-lg:h-fit max-lg:min-h-full max-sm:hidden">
                <div class="w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg w-fit text-right font-oswald_bold text-xl max-sm:text-base max-sm:font-oswald_medium">Mission et Objectifs</h4>
                </div>
                <p class="font-oswald_extralight text-base max-lg:font-sm max-sm:font-xs max-sm:font-oswald_extralight">Notre mission chez Deadly Air est de créer des vidéos époustouflantes et de faire rêver le monde du MTB dirt. <br> Nous souhaitons montrer la beauté et l'adrénaline de ce sport à travers nos aventures et nos réalisations. <br> Chaque saut, chaque figure, chaque ride est une occasion de repousser les limites et de capturer des moments inoubliables.</p>
            </article>
            <article id="#A4" class="relative gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-lg:h-fit max-lg:min-h-full">
                <div class="flex justify-end w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg w-fit text-right font-oswald_bold text-xl max-sm:text-base max-sm:font-oswald_medium">Valeurs et Culture</h4>
                </div>
                <p class="font-oswald_extralight text-base max-lg:font-sm max-sm:font-xs max-sm:font-oswald_extralight">Deadly Air repose sur des valeurs de tranquillité et de camaraderie. <br> Pour nous, rider entre amis est l'une des meilleures expériences au monde. <br> Le nom "Deadly Air" symbolise le sentiment de liberté que nous éprouvons en étant dans les airs, mais rappelle aussi que ce sport comporte des risques, et que chaque moment est précieux.</p>
            </article>
            <article id="#A5" class="relative gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-lg:h-fit max-lg:min-h-full max-sm:hidden">
                <div class="flex justify-end w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg w-fit text-right font-oswald_bold text-xl max-sm:text-base max-sm:font-oswald_medium">Événements et Activités</h4>
                </div>
                <p class="font-oswald_extralight text-base max-lg:font-sm max-sm:font-xs max-sm:font-oswald_extralight">Actuellement, nous ne pouvons pas encore organiser d'événements à cause de notre faible visibilité. <br> Cependant, nous travaillons dur pour gagner en notoriété et espérons organiser des compétitions et des rencontres dans un avenir proche.</p>
            </article>
            <article id="#A6" class="relative gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-lg:h-fit max-lg:min-h-full max-sm:hidden">
                <div class="flex justify-end w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg  w-fit text-right font-oswald_bold text-xl max-sm:text-base max-sm:font-oswald_medium">Membres et Communauté</h4>
                </div>
                <p class="font-oswald_extralight text-base max-lg:font-sm max-sm:font-xs max-sm:font-oswald_extralight">Deadly Air est composé de 6 membres passionnés : 4 riders et 2 caméramans. <br> Nos riders sont encore débutants, mais deux d'entre eux, Loic et Cuic, se démarquent par leur détermination et leur désir de progresser. <br> Nos caméramans sont très compétents et capturent nos aventures avec un talent remarquable.</p>
            </article>
            <article id="#A7" class="relative gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-lg:h-fit max-lg:min-h-full max-sm:hidden">
                <div class="flex justify-end w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg  w-fit text-right font-oswald_bold text-xl max-sm:text-base max-sm:font-oswald_medium">Partenariats et Collaborations</h4>
                </div>
                <p class="font-oswald_extralight text-base max-lg:font-sm max-sm:font-xs max-sm:font-oswald_extralight">Nous sommes un groupe encore jeune et nous ne travaillons pas encore avec d'autres organisations ou sponsors. <br> Cependant, nous sommes ouverts aux collaborations et espérons trouver des partenaires pour soutenir notre croissance et nos projets futurs.</p>
            </article>
            <article id="#A8" class="relative gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-lg:h-fit max-lg:min-h-full">
                <div class="flex justify-end w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg  w-fit text-right font-oswald_bold text-xl max-sm:text-base max-sm:font-oswald_medium">Vision Future</h4>
                </div>
                <p class="font-oswald_extralight text-base max-lg:font-sm max-sm:font-xs max-sm:font-oswald_extralight">Dans les cinq prochaines années, nous voyons Deadly Air comme un groupe de passionnés toujours en quête de nouveaux défis et de spectacles encore plus impressionnants. <br> Nous rêvons d'avoir notre propre terrain, avec des bosses et des pistes que nous pourrons aménager à notre guise, et où nous pourrons continuer à évoluer librement.</p>
            </article>
            <article id="#A9" class="relative bg-[url(Assets/Media/table.png)] bg-cover bg-repeat bg-center gap-y-2.5 py-5 px-8 flex flex-col bg-gris rounded-lg rounded-tl-[50px] rounded-br-[50px] text-blanc min-w-72 w-4/12 h-64 max-sm:hidden">
                <div class="flex justify-end w-full h-4">
                    <h4 class="p-2.5 absolute top-0 right-[-1px] rounded-bl-3xl rounded-tr-lg backdrop-blur-lg  w-fit text-right font-oswald_bold text-xl">26/06/24</h4>
                </div>   
            </article>

            <button id="ShowApropos" class="hidden max-sm:block text-center w-full bg-vert-2 text-blanc rounded-lg py-4 px-2">En Voir Plus</button>
        </div>
    </section>
    <script>
        let windowWidth = window.innerWidth;
        let articlesApropos = document.querySelectorAll('#Apropos article');
        const buttonShowApropos = document.querySelector('#ShowApropos');
        buttonShowApropos.addEventListener('click', function(){
            articlesApropos.forEach((articleApropos) => {
                if (articleApropos.classList.contains('max-sm:hidden')) {
                    articleApropos.classList.remove('max-sm:hidden');
                    articleApropos.classList.add('not-hidden');
                    buttonShowApropos.innerText = "En Voir Moins";
                    // console.log(windowWidth);
                }
                else if (articleApropos.classList.contains('not-hidden')) {
                    articleApropos.classList.add('max-sm:hidden');
                    articleApropos.classList.remove('not-hidden');
                };
            });
        });
        window.addEventListener('resize', function(){
            windowWidth = window.innerWidth;
            articlesApropos.forEach((articleApropos) => {
                if (windowWidth < 640){
                    if (articleApropos.classList.contains('not-hidden')) {
                        articleApropos.classList.add('max-sm:hidden');
                        articleApropos.classList.remove('not-hidden');
                        buttonShowApropos.innerText = "En Voir Plus";
                        window.location.href = "#Apropos";
                        // console.log(windowWidth);
                    }
                }
            });
        });
    </script>
    <script>
// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner la section #Apropos
    const sectionApropos = document.getElementById('Apropos');

    if (sectionApropos) {
        // Fonction pour vérifier si la section est visible dans le viewport
        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            var windowHeight = window.innerHeight || document.documentElement.clientHeight;
            // Calculer la position où la section est à 25% de la hauteur de l'écran
            var triggerPosition = windowHeight * 0.45;
            // Vérifier si le haut de la section est à 25% de la hauteur de l'écran
            return rect.top <= triggerPosition;
        }

        // Fonction pour ajouter la classe d'animation aux articles enfants
        function addAnimationClasses() {
            const articles = sectionApropos.querySelectorAll('article');
            articles.forEach((article, index) => {
                article.classList.add(`animation-apparition-a-propos-${index + 1}`);
            });
        }        
        function removeAnimationClasses() {
            const articles = sectionApropos.querySelectorAll('article');
            articles.forEach((article, index) => {
                // article.classList.add(`animation-apparition-a-propos-${index + 1}-reverse`);
                article.classList.remove(`animation-apparition-a-propos-${index + 1}`);
                setTimeout(function() {
                    // article.classList.remove(`animation-apparition-a-propos-${index + 1}-reverse`);
                }, 18000);
            });
        }

        // Fonction pour gérer le scroll
        function handleScroll() {
            if (isElementInViewport(sectionApropos)) {
                addAnimationClasses();
                // Retirer l'écouteur d'événement après avoir ajouté les classes pour éviter les répétitions
                // window.removeEventListener('scroll', handleScroll);
            }else{
                // removeAnimationClasses();
            }
        }

        // Écouter l'événement de défilement
        window.addEventListener('scroll', handleScroll);

        // Appel de la fonction pour vérifier initialement la position de la section Apropos
        handleScroll();
    }
});
    </script>


    <section id="Blog" class="flex flex-col items-center justify-around min-h-screen w-full">
        <header class="container flex justify-between items-center gap-16 px-8 py-2.5 h-20 w-full max-sm:gap-2">
            <h2 class="font-roadrage text-6xl max-sm:text-4xl">Blog</h2>
            <button class="lg:hidden h-full w-fit text-align px-8 text-blanc rounded-lg bg-vert-2">Voir tous les blogs</button>
        </header>
        <div class="flex w-full text-blanc justify-around max-lg:h-full">
            <div class="flex gap-8 justify-evenly px-12 w-[80%] max-lg:w-full max-lg:h-[50vh] max-sm:overflow-x-scroll">
                <?php if (empty($blogs)): ?>
                <p class="text-vert-2 text-2xl flex items-center">Aucun blogs n'est disponible</p>
                <?php else: ?>
                    <?php foreach($blogs as $blog): ?>
                        <?php 
                            $string = $blog['image_path'];
                            $partie_a_suppr = "../../../";
                            $img_res = str_replace($partie_a_suppr, "", $string);
                            // Exemple de récupération de la date depuis la base de données
                            $createdAt = $blog['created_at']; // 'YYYY-MM-DD'
                            $formattedDate = date('d/m/y', strtotime($createdAt));
                        ?>
                        <article class="flex flex-col bg-gris border-4 border-noir rounded-lg px-4 py-2.5 max-w-96 min-w-64 max-lg:w-80">
                            <img src="<?= $img_res?>" alt="Image Blog" class="rounded-lg h-2/4 object-cover">
                            <div class="h-2/4">
                                <h4 class="py-2.5 font-oswald_bold text-end"><?= $blog['title']?></h4>
                                <p class="font-oswald_extralight"><?= $blog['content']?></p>
                            </div>
                            <footer class="flex justify-between items-center py-4 px-2.5">
                                <div><?= $formattedDate ?></div>
                                <button class="like-button flex justify-between items-center p-4 bg-noir rounded-lg" data-blog-id="<?= $blog['id'] ?>" >
                                    <div class="likes-count"><?= $blog['likes'] ?></div>&nbsp;|
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_45_506)"><path d="M11.08 0.0576053C9.885 -0.241145 8.775 0.662605 8.695 1.83261C8.605 3.14636 8.4075 4.35261 8.16 5.07011C8.00375 5.52011 7.56125 6.33636 6.86 7.11886C6.16375 7.89761 5.2575 8.59136 4.19625 8.88136C3.35625 9.11011 2.5 9.83761 2.5 10.9001V15.9014C2.5 16.9576 3.3525 17.7314 4.31 17.8326C5.6475 17.9751 6.265 18.3514 6.895 18.7364L6.955 18.7739C7.295 18.9801 7.6775 19.2089 8.1675 19.3789C8.66375 19.5489 9.24375 19.6501 10 19.6501H14.375C15.5462 19.6501 16.3738 19.0539 16.7925 18.3201C16.9949 17.9739 17.1043 17.5811 17.11 17.1801C17.11 16.9901 17.0813 16.7901 17.0138 16.6001C17.265 16.2714 17.4887 15.8776 17.6237 15.4739C17.7612 15.0614 17.8387 14.5214 17.6287 14.0376C17.715 13.8751 17.7788 13.7014 17.8275 13.5339C17.9238 13.1964 17.9688 12.8239 17.9688 12.4626C17.9688 12.1026 17.9238 11.7314 17.8275 11.3926C17.7848 11.2365 17.727 11.085 17.655 10.9401C17.8739 10.6287 18.0147 10.2692 18.0656 9.89203C18.1165 9.51482 18.076 9.13089 17.9475 8.77261C17.69 8.03261 17.095 7.39761 16.4475 7.18261C15.3887 6.83011 14.1938 6.83761 13.3025 6.91886C13.1175 6.93557 12.9328 6.95641 12.7488 6.98136C13.1806 5.12415 13.154 3.18974 12.6713 1.34511C12.587 1.04959 12.4252 0.781962 12.2028 0.569892C11.9804 0.357823 11.7054 0.209014 11.4062 0.138855L11.08 0.0576053ZM14.375 18.4014H10C9.3625 18.4014 8.92125 18.3151 8.575 18.1964C8.22375 18.0751 7.9425 17.9114 7.605 17.7051L7.555 17.6751C6.86125 17.2514 6.0575 16.7614 4.4425 16.5901C4.02625 16.5451 3.75 16.2276 3.75 15.9026V10.9001C3.75 10.5826 4.0325 10.2214 4.525 10.0876C5.89375 9.7126 6.99625 8.84261 7.7925 7.95261C8.58625 7.06511 9.1225 6.10886 9.34 5.48011C9.64375 4.60511 9.84875 3.27011 9.9425 1.91761C9.97375 1.46511 10.3925 1.17511 10.7763 1.27011L11.1038 1.35261C11.3038 1.40261 11.4262 1.53136 11.4637 1.67136C11.9742 3.61638 11.9113 5.66754 11.2825 7.57761C11.2469 7.68384 11.2405 7.79769 11.264 7.90723C11.2875 8.01678 11.34 8.11799 11.4161 8.20028C11.4921 8.28257 11.5888 8.34292 11.6962 8.37499C11.8035 8.40707 11.9175 8.4097 12.0263 8.38261L12.03 8.38136L12.0475 8.37761L12.12 8.36011C12.5475 8.26959 12.9799 8.20407 13.415 8.16386C14.2438 8.08886 15.2363 8.09636 16.0525 8.36886C16.2713 8.44136 16.615 8.74386 16.765 9.18136C16.8987 9.56636 16.8737 10.0189 16.4325 10.4589L15.9913 10.9001L16.4325 11.3426C16.4862 11.3964 16.5638 11.5189 16.625 11.7364C16.685 11.9451 16.7188 12.1989 16.7188 12.4626C16.7188 12.7276 16.685 12.9801 16.625 13.1901C16.5625 13.4076 16.4862 13.5301 16.4325 13.5839L15.9913 14.0251L16.4325 14.4676C16.4912 14.5264 16.5688 14.6889 16.4388 15.0776C16.3042 15.455 16.0887 15.7984 15.8075 16.0839L15.3663 16.5251L15.8075 16.9676C15.815 16.9739 15.8588 17.0301 15.8588 17.1801C15.8514 17.3632 15.7995 17.5417 15.7075 17.7001C15.5012 18.0601 15.0788 18.4014 14.375 18.4014Z" fill="white"/></g><defs><clipPath id="clip0_45_506"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>      
                                </button>
                            </footer>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button type="menu" class="w-[20%] overflow-hidden max-lg:hidden" id="btn-VoirPlusDeBlog">
                <div id="effect-btn-VoirPlusDeBlog" class="h-[60vh] w-[70vh] p-5 bg-vert-2 flex items-center justify-start"><b>Voir tout les blogs</b></div>
            </button>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const likeButtons = document.querySelectorAll('.like-button');
            const timeoutDuration = 3000; // 3 seconds timeout
            let lastClickTime = {};

            likeButtons.forEach(button => {
                const blogId = button.getAttribute('data-blog-id');
                const liked = localStorage.getItem(`liked_${blogId}`) === 'true';
                
                button.setAttribute('data-liked', liked);

                // Update the UI based on the local storage value
                if (liked) {
                    button.classList.add('liked');
                } else {
                    button.classList.remove('liked');
                }

                button.addEventListener('click', async () => {
                    const currentTime = new Date().getTime();

                    if (lastClickTime[blogId] && (currentTime - lastClickTime[blogId]) < timeoutDuration) {
                        console.warn('Please wait before clicking again.');
                        alert('Veuillez patienter avant de cliquer à nouveau.');
                        return;
                    }

                    lastClickTime[blogId] = currentTime;

                    const liked = button.getAttribute('data-liked') === 'true';
                    const newLikedState = !liked;
                    button.setAttribute('data-liked', newLikedState);
                    
                    // Save the new liked state in local storage
                    localStorage.setItem(`liked_${blogId}`, newLikedState);

                    // Update the UI based on the new liked state
                    if (newLikedState) {
                        button.classList.add('liked');
                    } else {
                        button.classList.remove('liked');
                    }

                    // Send the new liked state to the server
                    try {
                        const response = await fetch('Assets/php/like_blog.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ blogId, liked: newLikedState })
                        });
                        
                        const result = await response.json();
                        if (result.success) {
                            // Update the likes count if necessary
                            button.querySelector('.likes-count').textContent = result.likes;
                        } else {
                            // Handle error
                            console.error('Error updating likes');
                        }
                    } catch (error) {
                        console.error('Network error:', error);
                    }
                });
            });
        });


    </script>


    <section id="Boutique" class="container flex flex-col items-center justify-around h-screen w-full">
        <header class="flex justify-between items-center gap-8 px-8 py-2.5 h-20 w-full max-sm:gap-2">
            <h2 class="font-roadrage text-6xl max-sm:text-4xl">Boutique</h2>
            <i class="text-vert-2 text-xl text-end max-lg:text-base max-lg:font-oswald_light max-sm:font-oswald_extralight max-sm:text-xs">— Supportez Deadly Air et montrez votre passion pour le bike avec nos produit
                exclusifs.</i>
        </header>
        <div class="container flex flex-wrap items-center justify-center gap-8">
            <stripe-buy-button class="shadow-2xl" buy-button-id="buy_btn_1PWIuu04M5kzYwtLd07fN3Yd"
                publishable-key="pk_test_51PWIkA04M5kzYwtLw3sfjOEcCfScxJoYlSr5apaG758qY0AixsxFqJftHyUzWB8ObsDhNciwzgdlSsB4dFsvjeDo00lYVnQHOc">
            </stripe-buy-button>
            <stripe-buy-button class="shadow-2xl" buy-button-id="buy_btn_1PWJ2G04M5kzYwtLnrU8VKkr"
                publishable-key="pk_test_51PWIkA04M5kzYwtLw3sfjOEcCfScxJoYlSr5apaG758qY0AixsxFqJftHyUzWB8ObsDhNciwzgdlSsB4dFsvjeDo00lYVnQHOc">
            </stripe-buy-button>
        </div>
    </section>
    <section id="Contact" class="flex flex-col items-center justify-around pt-16 h-screen text-blanc bg-gris w-full">
        <header class="container flex justify-between items-center gap-16 px-8 py-2.5 h-20 w-full max-sm:gap-2">
            <h2 class="font-roadrage text-6xl max-sm:text-4xl">Contact</h2>
            <i class="text-vert-2 text-xl text-end max-lg:text-base max-lg:font-oswald_light max-sm:font-oswald_extralight max-sm:text-xs">-  Vous avez des questions, des suggestions, ou vous voulez simplement dire bonjour ? <br> Nous aimerions avoir de vos nouvelles.</i>
        </header>
        <div class="flex jsutify-between items-center flex-1 gap-8 px-4 max-sm:flex-col max-sm:items-baseline">
            <div class="h-2/4">
                <form   action="https://formspree.io/f/mzzppqep" method="POST" class="flex flex-col gap-y-16 h-full">
                    <div class="flex justify-between gap-16">
                        <input type="text" id="name" name="name" placeholder="Nom" class="bg-noir h-12 rounded-lg w-4/6 px-2.5 py-4" autocomplete="off" required>
                        <input type="email" id="email" name="email" placeholder="E-Mail" class="bg-noir h-12 rounded-lg w-4/6 px-2.5 py-4" required>
                    </div>
                    <textarea id="message" name="message" class="bg-noir rounded-lg resize-none h-full px-2.5 py-4" placeholder="Ecrit ton message ici" autocomplete="off" minlength="150" maxlength="450" required></textarea>
                    <button class="w-full h-12 bg-vert-2 rounded-lg p-2.5">Envoyer</button>
                </form>
            </div>
            <div class="h-2/4 flex flex-col gap-y-16">
                <a class="flex items-center gap-4 underline hover:text-vert-2" href="mailto:cuic.professional@gmail.com"><svg width="38" height="30" viewBox="0 0 38 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5C0.5 3.67392 0.987275 2.40215 1.85463 1.46447C2.72199 0.526784 3.89837 0 5.125 0H32.875C34.1016 0 35.278 0.526784 36.1454 1.46447C37.0127 2.40215 37.5 3.67392 37.5 5V25C37.5 26.3261 37.0127 27.5979 36.1454 28.5355C35.278 29.4732 34.1016 30 32.875 30H5.125C3.89837 30 2.72199 29.4732 1.85463 28.5355C0.987275 27.5979 0.5 26.3261 0.5 25V5ZM5.125 2.5C4.51169 2.5 3.92349 2.76339 3.48982 3.23223C3.05614 3.70107 2.8125 4.33696 2.8125 5V5.5425L19 16.0425L35.1875 5.5425V5C35.1875 4.33696 34.9439 3.70107 34.5102 3.23223C34.0765 2.76339 33.4883 2.5 32.875 2.5H5.125ZM35.1875 8.4575L24.3002 15.52L35.1875 22.7625V8.4575ZM35.1089 25.6475L22.0664 16.97L19 18.9575L15.9336 16.97L2.89113 25.645C3.02253 26.177 3.31273 26.6472 3.71666 26.9826C4.1206 27.3181 4.61566 27.4999 5.125 27.5H32.875C33.384 27.5001 33.8789 27.3186 34.2828 26.9836C34.6867 26.6487 34.977 26.179 35.1089 25.6475ZM2.8125 22.7625L13.6998 15.52L2.8125 8.4575V22.7625Z" fill="#0D962B"/></svg><span>cuic.professional@gmail.com</span></a>
                <a class="flex items-center gap-4 underline hover:text-vert-2" href="tel:06.77.56.32.72"><svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.03515 1.29011C4.36321 0.962511 4.75715 0.708379 5.19086 0.544556C5.62456 0.380733 6.08812 0.310959 6.55083 0.339859C7.01354 0.368758 7.46482 0.49567 7.87477 0.712185C8.28472 0.9287 8.64398 1.22987 8.92874 1.59575L12.2943 5.9197C12.9111 6.71286 13.1286 7.74603 12.8849 8.72108L11.8593 12.8275C11.8066 13.0402 11.8097 13.2629 11.8681 13.4741C11.9266 13.6853 12.0385 13.8778 12.193 14.0332L16.7997 18.6403C16.9553 18.7951 17.1481 18.9072 17.3597 18.9657C17.5712 19.0242 17.7942 19.027 18.0072 18.974L22.1115 17.9484C22.5926 17.8288 23.0947 17.8198 23.5798 17.9221C24.065 18.0244 24.5207 18.2353 24.9126 18.539L29.2362 21.9029C30.7906 23.1124 30.9331 25.4093 29.5418 26.7988L27.6032 28.7376C26.2157 30.1252 24.142 30.7346 22.209 30.0539C17.2604 28.3149 12.7678 25.482 9.06561 21.766C5.35018 18.0642 2.51748 13.5719 0.778374 8.62357C0.0996456 6.69223 0.709001 4.61651 2.09646 3.22895L4.03515 1.29011Z" fill="#0D962B"/></svg><span>06.77.56.32.72</span></a>
                <a class="flex items-center gap-4 underline hover:text-vert-2" href=""><svg width="38" height="31" viewBox="0 0 38 31" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.1191 0.666504H19.3249C21.2259 0.674512 30.8581 0.75459 33.4552 1.56071C34.2403 1.80674 34.9557 2.28628 35.53 2.95143C36.1042 3.61657 36.5172 4.44402 36.7276 5.35108C36.9612 6.36541 37.1254 7.70806 37.2364 9.09341L37.2595 9.37101L37.3104 10.065L37.3289 10.3426C37.4792 12.7823 37.4977 15.0673 37.5 15.5664V15.7666C37.4977 16.2844 37.4769 18.7242 37.3104 21.2653L37.2919 21.5456L37.271 21.8232C37.1554 23.35 36.9843 24.8662 36.7276 25.9819C36.5172 26.889 36.1042 27.7164 35.53 28.3816C34.9557 29.0467 34.2403 29.5263 33.4552 29.7723C30.7725 30.6051 20.5761 30.6638 19.163 30.6665H18.8346C18.12 30.6665 15.1645 30.6505 12.0655 30.5277L11.6724 30.5117L11.4712 30.501L11.0757 30.4823L10.6803 30.4636C8.11323 30.3328 5.66876 30.122 4.5425 29.7696C3.75765 29.5238 3.0424 29.0447 2.46818 28.38C1.89395 27.7154 1.48085 26.8885 1.27011 25.9819C1.01341 24.8688 0.842271 23.35 0.726639 21.8232L0.708138 21.5429L0.689637 21.2653C0.574845 19.4566 0.511599 17.6441 0.5 15.8307L0.5 15.5023C0.504625 14.9284 0.523126 12.9452 0.648009 10.7564L0.664198 10.4814L0.671136 10.3426L0.689637 10.065L0.740515 9.37101L0.763641 9.09341C0.874648 7.70806 1.03885 6.36274 1.27242 5.35108C1.48281 4.44402 1.89576 3.61657 2.47 2.95143C3.04425 2.28628 3.75969 1.80674 4.54482 1.56071C5.67107 1.21371 8.11554 1.00016 10.6826 0.866699L11.0757 0.848015L11.4735 0.831999L11.6724 0.823992L12.0678 0.805307C14.2688 0.723636 16.4707 0.678253 18.6728 0.669173L19.1191 0.666504ZM15.3009 9.23488V22.0955L24.9146 15.6678L15.3009 9.23488Z" fill="#0D962B"/></svg><span>Youtube</span></a>
                <a class="flex items-center gap-4 underline hover:text-vert-2" href=""><svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 0C11.4294 0 10.9175 0.01875 9.31812 0.09C7.71875 0.165 6.62938 0.41625 5.675 0.7875C4.67346 1.16311 3.76651 1.75387 3.01813 2.51813C2.25387 3.26651 1.66311 4.17346 1.2875 5.175C0.91625 6.1275 0.663125 7.21875 0.59 8.8125C0.51875 10.4156 0.5 10.9256 0.5 15.0019C0.5 19.0744 0.51875 19.5844 0.59 21.1838C0.665 22.7812 0.91625 23.8706 1.2875 24.825C1.67188 25.8112 2.18375 26.6475 3.01813 27.4819C3.85063 28.3162 4.68688 28.83 5.67313 29.2125C6.62938 29.5837 7.71688 29.8369 9.31437 29.91C10.9156 29.9813 11.4256 30 15.5 30C19.5744 30 20.0825 29.9813 21.6838 29.91C23.2794 29.835 24.3725 29.5837 25.3269 29.2125C26.3277 28.8366 27.234 28.2459 27.9819 27.4819C28.8162 26.6475 29.3281 25.8112 29.7125 24.825C30.0819 23.8706 30.335 22.7812 30.41 21.1838C30.4813 19.5844 30.5 19.0744 30.5 15C30.5 10.9256 30.4813 10.4156 30.41 8.81437C30.335 7.21875 30.0819 6.1275 29.7125 5.175C29.3369 4.17346 28.7461 3.26651 27.9819 2.51813C27.2335 1.75387 26.3265 1.16311 25.325 0.7875C24.3687 0.41625 23.2775 0.163125 21.6819 0.09C20.0806 0.01875 19.5725 0 15.4963 0H15.5ZM14.1556 2.70375H15.5019C19.5069 2.70375 19.9812 2.71688 21.5619 2.79C23.0244 2.85562 23.8194 3.10125 24.3481 3.30562C25.0475 3.5775 25.5481 3.90375 26.0731 4.42875C26.5981 4.95375 26.9225 5.4525 27.1944 6.15375C27.4006 6.68062 27.6444 7.47563 27.71 8.93813C27.7831 10.5188 27.7981 10.9931 27.7981 14.9963C27.7981 18.9994 27.7831 19.4756 27.71 21.0562C27.6444 22.5187 27.3988 23.3119 27.1944 23.8406C26.9522 24.4911 26.5686 25.0796 26.0712 25.5637C25.5462 26.0887 25.0475 26.4131 24.3463 26.685C23.8213 26.8913 23.0262 27.135 21.5619 27.2025C19.9812 27.2738 19.5069 27.2906 15.5019 27.2906C11.4969 27.2906 11.0206 27.2738 9.44 27.2025C7.9775 27.135 7.18437 26.8913 6.65562 26.685C6.00469 26.4436 5.4155 26.0606 4.93062 25.5637C4.43239 25.0793 4.04812 24.49 3.80562 23.8387C3.60125 23.3119 3.35562 22.5169 3.29 21.0544C3.21875 19.4737 3.20375 18.9994 3.20375 14.9925C3.20375 10.9856 3.21875 10.515 3.29 8.93437C3.3575 7.47187 3.60125 6.67688 3.8075 6.14813C4.07938 5.44875 4.40562 4.94812 4.93062 4.42312C5.45563 3.89812 5.95437 3.57375 6.65562 3.30188C7.18437 3.09563 7.9775 2.85187 9.44 2.78437C10.8238 2.72062 11.36 2.70187 14.1556 2.7V2.70375ZM23.5081 5.19375C23.2717 5.19375 23.0377 5.24031 22.8193 5.33077C22.6009 5.42123 22.4025 5.55381 22.2353 5.72096C22.0682 5.8881 21.9356 6.08653 21.8451 6.30492C21.7547 6.52331 21.7081 6.75737 21.7081 6.99375C21.7081 7.23013 21.7547 7.46419 21.8451 7.68258C21.9356 7.90097 22.0682 8.0994 22.2353 8.26654C22.4025 8.43369 22.6009 8.56627 22.8193 8.65673C23.0377 8.74719 23.2717 8.79375 23.5081 8.79375C23.9855 8.79375 24.4433 8.60411 24.7809 8.26654C25.1185 7.92898 25.3081 7.47114 25.3081 6.99375C25.3081 6.51636 25.1185 6.05852 24.7809 5.72096C24.4433 5.38339 23.9855 5.19375 23.5081 5.19375ZM15.5019 7.2975C14.4801 7.28156 13.4654 7.46904 12.5168 7.84901C11.5682 8.22899 10.7047 8.79388 9.97653 9.51079C9.24835 10.2277 8.67006 11.0823 8.27533 12.0249C7.8806 12.9674 7.67731 13.9791 7.67731 15.0009C7.67731 16.0228 7.8806 17.0345 8.27533 17.977C8.67006 18.9196 9.24835 19.7742 9.97653 20.4911C10.7047 21.208 11.5682 21.7729 12.5168 22.1529C13.4654 22.5328 14.4801 22.7203 15.5019 22.7044C17.5241 22.6728 19.4529 21.8473 20.8718 20.4061C22.2908 18.9649 23.0861 17.0234 23.0861 15.0009C23.0861 12.9784 22.2908 11.037 20.8718 9.59578C19.4529 8.15454 17.5241 7.32905 15.5019 7.2975ZM15.5019 9.99938C16.1586 9.99938 16.8088 10.1287 17.4155 10.38C18.0222 10.6313 18.5735 10.9997 19.0379 11.464C19.5022 11.9284 19.8705 12.4796 20.1219 13.0863C20.3732 13.693 20.5025 14.3433 20.5025 15C20.5025 15.6567 20.3732 16.307 20.1219 16.9137C19.8705 17.5204 19.5022 18.0716 19.0379 18.536C18.5735 19.0003 18.0222 19.3687 17.4155 19.62C16.8088 19.8713 16.1586 20.0006 15.5019 20.0006C14.1756 20.0006 12.9037 19.4738 11.9659 18.536C11.0281 17.5982 10.5013 16.3262 10.5013 15C10.5013 13.6738 11.0281 12.4018 11.9659 11.464C12.9037 10.5262 14.1756 9.99938 15.5019 9.99938Z" fill="#0D962B"/></svg><span>Instagram</span></a>
            </div>
        </div>
    </section>
    <footer class="flex flex-col min-h-[100px] bg-gris text-blanc border-t-2 border-trans70 w-full">
        <img src="Assets/Media/Logo.webp" alt="Logo" class="max-h-[80px] max-w-[80px] m-4 rounded-lg">
        <div class="flex justify-between w-full px-2.5 py-4 text-sm max-lg:text-xs max-md:flex-col max-md:justify-center max-md:items-center max-md:text-sm max-md:text-center">
            <div>
                <a href="Politique/politique_de_confidentialite.html" class="underline hover:text-vert-2">Politique de confidentialité</a>
                <a href="Politique/cgu.html" class="underline hover:text-vert-2">Conditions d'utilisation</a>
                <a href="Politique/cgv.html" class="underline hover:text-vert-2">Conditions générales de vente</a>
            </div>
            <div>
                <p>© 2024 Deadly Air. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>


