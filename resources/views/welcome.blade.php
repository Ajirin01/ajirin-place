@extends('layouts.app')

@section('content')
<section class="slider_section">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        <div class="carousel-item active">

            <div class="container-fluid padding_dd">
            <div class="carousel-caption">
                <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="text-bg">
                    <h1>Search your Favorite Course here</h1>
                    <p>TOP NOTCH COURSES FROM TRAINED PROFESSIONALS</p>
                    <a href="#">Read more</a> <a href="#">get a qoute</a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                    <div class="images_box">
                    <figure><img src="{{asset('site/images/digi-img2.png')}}"></figure>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="carousel-item">

            <div class="container-fluid padding_dd">
            <div class="carousel-caption">

                <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="text-bg">
                    <h1>Search your Favorite Course here</h1>
                    <p>TOP NOTCH COURSES FROM TRAINED PROFESSIONALS</p>
                    <a href="#">Read more</a><a href="#">get a qoute</a>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                    <div class="images_box">
                    <figure><img src="{{asset('site/images/student4.png')}}"></figure>
                    </div>
                </div>
                </div>
            </div>
            </div>

        </div>


        <div class="carousel-item">

            <div class="container-fluid padding_dd">
            <div class="carousel-caption ">
                <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="text-bg">
                    <h1>Search your Favorite Course here</h1>
                    <p>TOP NOTCH COURSES FROM TRAINED PROFESSIONALS</p>
                    <a href="#">Read more</a> <a href="#">get a qoute</a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                    <div class="images_box">
                    <figure><img src="{{asset('site/images/student5.png')}}"></figure>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>

    </section>
</div>
</header>


{{-- <main class="py-4">
@yield('content')
</main> --}}
<!-- about  -->
<div id="about" class="about">
<div class="container">
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
    <div class="about-box">
        <h2>About <strong class="yellow">Our Programs</strong></h2>
        <p>Digi-Realm City Solution is an integrated Information Communication and Technology company that is well-positioned
            to deliver complete Information Technology skills by successfully combininig both Theoritical and practicals to 
            equipe learners with the required skills. Our certified processes and years of experience are reflected in the success 
            we have achieved in training of learners. With our learning plateform, learners can learn online or in class or both.
          </p>
        <a href="#courses">View Courses</a>
    </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
    <div class="about-box">
        <figure><img src="{{asset('site/images/about.jpg')}}" alt="#" /></figure>
    </div>
    </div>
</div>

</div>
</div>
<!-- end abouts -->



<!-- our -->
<div id="important" class="important">
<div class="container">
<div class="row">
    <div class="col-md-12">
    <div class="titlepage">
        <h2>Some <strong class="yellow">important facts</strong></h2>
        <span>92% of web developers are men according to a recent survey	Companies <br>
            Microsoft is the largest software company. In 2020 it made $138.6 billion	<br>
            Java is the most popular programming languages. 59% of developers use it	<br>
            {{-- Apple's original logo was Isaac newton leant against an apple tree.	
            IBM was founded in 1896 with the name "Tabulating Machine Company" --}}
        </span>
    </div>
    </div>
</div>
</div>
<div class="important_bg">
    <div class="container">
        <div class="row">
        <div class="col col-xs-12">
            <div class="stat-count">
                <div class="important_box">
                    <h3 class="stat-timer">20+</h3>
                    <span><i class="glyhicon glyhicon-user"></i>Graduates</span>
                </div>
            </div>
            
        </div>
        <div class="col col-xs-12">
            <div class="stat-count">
                <div class="important_box">
                    <h3 class="stat-timer">50+</h3>
                    <span>Courses</span>
                </div>
            </div>
            
        </div>
        <div class="col col-xs-12">
            <div class="stat-count">
                <div class="important_box">
                    <h3 class="stat-timer">200+</h3>
                    <span>Members</span>
                </div>
            </div>
            
        </div>
        {{-- <div class="col col-xs-12">
            <div class="important_box">
            <h3>10+</h3>
            <span>countries</span>
            </div>
        </div> --}}
        </div>
    </div>
</div>
</div>
</div>

<!-- end our -->
<!-- Courses -->
<div id="courses" class="Courses">
<div class="container-fluid padding_left3">
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
    <div class="box_bg">
        <div class="box_bg_img">
            <div class="row">
                @foreach ($courses as $course)
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="box_my">
                        <figure><a href="{{url('courses/course/'.$course->id.'/detail')}}"><img style="height: 150px" alt="course image" src="public{{$course->course_image}}"></a></figure>
                        <div class="overlay">
                            <h3>{{$course->course_name}}</h3>
                            <p>{{$course->course_description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 border_right">
    <div class="box_text">
        <div class="titlepage">
        <h2>Our <strong class="yellow"> Courses</strong></h2>
        </div>
        <p>We offer purposeful and insightful ICT training, with optimal fusion of practical and theoritical training. Courses
            we offer are: Website design and development, Software development, Cisco Networking and Implimentation, Mobile/
            Andriod App. Development, Microsoft Technical Associate Networking, Microsoft Technical Associate Security,
            Microsoft Technical Associate Sever Administration and configuration, MTA Cloud computing, CyberSecurity an 
            Graphics design with Computer utilization.
        </p>
        <a href="#contact">Contact Us</a>
    </div>
    </div> 
</div>
</div>
</div>
<!-- end Courses -->

<!-- learn -->


<div id="learn" class="learn">
<div class="container">
<div class="row">
    <div class="col-md-12">
    <div class="titlepage">
        <h2>Learn <strong class="yellow">the Practical way online</strong></h2>
        <span>We are also working to make available vidoe materials to students
            to make learning more effective for them. They will be able to have virtual lectures online. Coming soon!!!</span>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="learn_box">
        <figure><img src="{{asset('site/images/img.jpg')}}" alt="img"/></figure>
    </div>
    </div>
</div>
</div>
</div>
<!-- MAKE --> 
<div class="make">
<div class="container">
<div class="row">
    <div class="col-md-12">
    <div class="titlepage">
        <h2>You Can Also <strong class="white_colo" style="font-size: 1.5rem">Request Quotes for the following Services:</strong></h2>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
    <div class="make_text">
        <p><strong>ICT SERVICES</strong> <br>
            We offer purposeful and insightful ICT Services, with optimal fusion of intelligence, process, and technology to assist clients in developing solutions, Networking, and infrastructure with a new, invigorating operating model—one that establishes unmatched customer experiences and satisfaction.</p>

            <p><strong>BPO SERVICES</strong> <br>
                Our focus is to promotes process optimization that includes all clients in order to work with a lean budget and costs while converting their business operations for a sustainable benefit.</p>
        <!-- <a href="#contact">Contact</a> -->
        <p><strong>ICT PROJECT IMPLEMENTATION</strong> <br>
        We offer comprehensive ICT implementation services meant to channel our core technologies as enterprise backbones to our customers’ operation and processing environments.

        </p>
        <p><strong>SYSTEM MAINTENANCE AND SUPPORT</strong> <br>
            We offer ICT infrastructure maintenance and support Services both remotely and physicallly to keep Service delivery at optimum capacity.</p>
        <p><strong>RESEARCH AND DEVELOPMENT</strong> <br>
            We keep our clients updated with the most recent and trending technology to keep at par with best practices and methodologies.</p>
        
        <a href="#contact">Contact Us</a>
    </div>
    </div>
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
    <div class="make_img">
        <figure><img src="{{asset('site/images/make_img.jpg')}}"></figure>
    </div>
    </div>
</div>
</div>
</div>
<!-- end MAKE --> 
<!-- end learn --> 

@endsection

