<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/stylesheets/shared/home.css">
    <link rel="stylesheet" type="text/css" href="../../jquery-plugin/carousel/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="../../jquery-plugin/carousel/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="../../../src/stylesheets/shared/nav_bar.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
    <title>Maffy - The learning Platform</title>
</head>

<body>
    <?php include '../shared/navbar.php';?>
    <div class="content">
        <!-- section for home -->
        <section id="home" class="home-container white-bg h-screen w-screen">
            <div
                class="home-content sm:h-5/6 sm:items-center flex-col-reverse sm:flex-row mx-9 sm:mx-12 my-10 sm:my-20">
                <div class="search-details w-full sm:w-1/2 lg:w-4/12 ml-3 lg:ml-24 mt-8 sm:mt-10 lg:mt-24">
                    <div class="mb-4 sm:mb-12">
                        <h2>What is</h2>
                        <h2>Lorem Ipsum?</h2>
                    </div>
                    <div class="pr-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit,
                        </p>
                    </div>

                    <div class="search-cont mt-4 sm:mt-10 mb-4 sm:mb-10">
                        <input type="text" class="search__input" placeholder="What to learn..">
                        <button class="search__button">
                            <i class="fa-solid fa-magnifying-glass" style="color: #dee2e8;"></i>
                        </button>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 mt-8 sm:mt-28 lg:mt-24 sm:mr-10">
                    <img src="../../images/intro.png" alt="introduction" class="w-64 sm:w-4/5 intro-img">
                </div>
            </div>
        </section>

        <!-- section for about us -->
        <section id="about-us" class="flex flex-col h-screen w-screen green-bg">
            <div class="overflow-hidden absolute h-4/6 w-screen">
                <img src="../../images/technology.png" alt="technology" class="techImg">
            </div>
            <div class="flex justify-center items-center w-full relative top-20 sm:top-64 lg:top-80">
                <div class="flex about-us-cont flex-col sm:flex-row w-3/4 sm:w-5/6 lg:4/6">
                    <!-- maffy details -->
                    <div class="flex flex-col w-full sm:w-1/2">
                        <!-- logo -->
                        <div
                            class="flex flex-row sm:flex-col sm:w-full h-40 sm:h-36 md:h-56 lg:h-64 pr-5 py-5 lg:px-16 justify-center">
                            <img src="../../images/Maffy.png" alt="logo" class="logo-img">
                        </div>
                        <!-- contact us button -->
                        <div id="normal-responsive-contact"
                            class="flex flex-row sm:w-10/12 mb-5 justify-center lg:pl-6">
                            <button class="learn-more contact-btn mx-5">
                                <span class="circle" aria-hidden="true">
                                    <span class="icon arrow"></span>
                                </span>
                                <span class="button-text">Contact Us</span>
                            </button>
                        </div> <!-- normal-responsive-contact -->
                    </div>
                    <!-- content details -->
                    <div class="sm:w-1/2 p-5">
                        <h2 class="mb-4 sm:mb-8">Who we are</h2>
                        <p>
                            Welcome to MAFFY, the premier online destination for anyone who wants to learn how to code.
                            We believe that coding is an essential skill for the 21st century, and we're dedicated to
                            making it accessible to everyone.
                        </p>
                        <div id="mobile-responsive-contact" class="flex flex-row w-full my-5">
                            <button class="learn-more contact-btn">
                                <span class="circle" aria-hidden="true">
                                    <span class="icon arrow"></span>
                                </span>
                                <span class="button-text">Contact Us</span>
                            </button>
                        </div> <!-- mobile-responsive-contact -->
                    </div>
                </div>
            </div>
        </section>

        <!-- section for course -->
        <section id="course" class="course-container h-screen w-screen">
            <div class="flex flex-col items-center justify-center">
                <!-- text -->
                <h2 class="my-5 sm:my-10 lg:my-16">Our course</h2>
                <!-- slider -->
                <div class="w-screen h-full flex flex-row justify-center items-center">
                    <div class="slider-container w-3/4 lg:w-5/6">

                        <div class="slider-card mx-3 lg:mx-8">
                            <a href="" class="h-3/5">
                                <img src="../../images/faq.png">
                            </a>
                            <div class="slider-caption h-2/5">

                                <h2 class="my-3">Course name</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>

                        <div class="slider-card mx-3 lg:mx-8">
                            <a href="" class="h-3/5">
                                <img src="../../images/technology.png">
                            </a>
                            <div class="slider-caption h-2/5">

                                <h2 class="my-3">Course name</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>

                        <div class="slider-card mx-3 lg:mx-8">
                            <a href="" class="h-3/5">
                                <img src="../../images/intro.png">
                            </a>
                            <div class="slider-caption h-2/5">

                                <h2 class="my-3">Course name</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>

                        <div class="slider-card mx-3 lg:mx-8">
                            <a href="" class="h-3/5">
                                <img src="../../images/our course.png">
                            </a>
                            <div class="slider-caption h-2/5">

                                <h2 class="my-3">Course name</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>

                        <div class="slider-card mx-3 lg:mx-8">
                            <a href="" class="h-3/5">
                                <img src="../../images/Maffy.png">
                            </a>
                            <div class="slider-caption h-2/5">

                                <h2 class="my-3">Course name</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>

                    </div> <!-- slider container -->
                </div>
            </div>
        </section>

        <!-- section for faq -->
        <section id="faq" class="faq-container h-screen w-screen">
            <div class="flex flex-col items-center justify-center">
                <!-- text -->
                <h2 class="my-5 sm:my-10 lg:my-16 text-center">Frequently Asked Questions</h2>
                <div class="accordion">
                    <div class="accordion-item">
                        <button id="accordion-button-1" aria-expanded="false">
                            <h2 class="accordion-title">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </h2>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et
                                leo duis ut. Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button id="accordion-button-2" aria-expanded="false">
                            <h2 class="accordion-title">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </h2>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et
                                leo duis ut. Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button id="accordion-button-3" aria-expanded="false">
                            <h2 class="accordion-title">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </h2>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et
                                leo duis ut. Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button id="accordion-button-4" aria-expanded="false">
                            <h2 class="accordion-title">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </h2>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et
                                leo duis ut. Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button id="accordion-button-5" aria-expanded="false">
                            <h2 class="accordion-title">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </h2>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et
                                leo duis ut. Ut tortor pretium viverra suspendisse potenti.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="footer" class="flex flex-row justify-center copyright">
            <p>COPYRIGHT @ MAFFY</p>
        </section>
    </div>

    <!-- ======================================================================================================= -->
    <!-- ==================================       Script       ================================================= -->
    <!-- ======================================================================================================= -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../jquery-plugin/carousel/slick/slick.min.js"></script>
    <script>
    // this is the function for the slider with using jQuery plugin and some params
    $(document).ready(function() {
        $('.slider-container').slick({
            centerMode: true,
            centerPadding: '0px',
            slidesToShow: 3,
            slidesToScroll: 1,
            variableWidth: true,
            autoplay: true,
            autoplaySpeed: 2000,
            infinite: true,
            dots: true,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev">Previous</button>',
            nextArrow: '<button type="button"class="slick-next">Next</button>',
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 320,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        slidesToShow: 1,
                    }
                }
            ]
        });
    });

    //this javascript is for the accordion
    const items = document.querySelectorAll(".accordion button"); //get all class for accordion button
    function toggleAccordion() {
        const itemToggle = this.getAttribute('aria-expanded');

        for (i = 0; i < items.length; i++) {
            items[i].setAttribute('aria-expanded', 'false');
        }

        if (itemToggle == 'false') {
            this.setAttribute('aria-expanded', 'true');
        }
    }

    items.forEach(item => item.addEventListener('click', toggleAccordion));
    </script>
</body>

</html>