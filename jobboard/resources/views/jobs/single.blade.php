@extends('layouts.app')

@section('content')

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="margin-top: -24px; background-image: url({{ asset('assets/images/hero_1.jpg') }});" id="home-section">
    <div class="container">
    <div class="row">
        <div class="col-md-7">
        <h1 class="text-white font-weight-bold">{{ $job->job_title }}</h1>
        <div class="custom-breadcrumbs">
            <a href="#">Home</a> <span class="mx-2 slash">/</span>
            <a href="#">Job</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong>{{ $job->job_title }}</strong></span>
        </div>
        </div>
    </div>
    </div>
</section>


<section class="site-section">
    <div class="container">
    <div class="row align-items-center mb-5">
        <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="d-flex align-items-center">
            <div class="border p-2 d-inline-block mr-3 rounded">
            <img src="{{ asset('assets/images/' . $job->image . '') }}" alt="Image">
            </div>
            <div>
            <h2>{{ $job->job_title }}</h2>
            <div>
                <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span>{{ $job->company }}</span>
                <span class="m-2"><span class="icon-room mr-2"></span>{{ $job->job_region }}</span>
                <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary">{{ $job->job_type }}</span></span>
            </div>
            </div>
        </div>
        </div>

    <div class="row">
        <div class="col-lg-8">
        <div class="mb-5">
            <figure class="mb-5"><img src="{{ asset('assets/images/job_single_img_1.jpg') }}" alt="Image" class="img-fluid rounded"></figure>
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
            <p>{{ $job->job_description }}</p>
        </div>
        <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
            <p>{{ $job->responsibilities }}</p>
        </div>

        <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Education + Experience</h3>
            <p>{{ $job->education_experience }}</p>
            <p>{{ $job->experience }}</p>
        </div>

        <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Other Benefits</h3>
            <p>{{ $job->other_benefits }}</p>
        </div>

        <div class="row mb-5">
            <div class="col-6">
                <form action="{{ route('save.job') }}" method="POST">
                    @csrf
                    <input name="job_id" type="text" value="{{ $job->id }}">
                    <input name="user_id" type="text" value="{{ Auth::user()->id }}">
                    <input name="job_image" type="text" value="{{ $job->image }}">
                    <input name="job_title" type="text" value="{{ $job->job_title }}">
                    <input name="job_region" type="text" value="{{ $job->job_region }}">
                    <input name="job_type" type="text" value="{{ $job->job_type }}">
                    <input name="company" type="text" value="{{ $job->company }}">
                
                    <button name="submit" type="submit" class="btn btn-block btn-light btn-md"><i class="icon-heart"></i>Save Job</button>
                </form>
            </div>
            <div class="col-6">
            <button class="btn btn-block btn-primary btn-md">Apply Now</button>
            </div>
        </div>

        </div>
        <div class="col-lg-4">
        <div class="bg-light p-3 border rounded mb-4">
            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
            <ul class="list-unstyled pl-3 mb-0">
            <li class="mb-2"><strong class="text-black">Published on:</strong> {{ $job->created_at }}</li>
            <li class="mb-2"><strong class="text-black">Vacancy:</strong> {{ $job->vacancy }}</li>
            <li class="mb-2"><strong class="text-black">Employment Status:</strong> {{ $job->job_type }}</li>
            <li class="mb-2"><strong class="text-black">Experience:</strong> {{ $job->experience }}</li>
            <li class="mb-2"><strong class="text-black">Job Location:</strong> {{ $job->job_region }} </li>
            <li class="mb-2"><strong class="text-black">Salary:</strong> {{ $job->salary }}</li>
            <li class="mb-2"><strong class="text-black">Application Deadline:</strong> {{ $job->application_deadline }}</li>
            </ul>
        </div>

        <div class="bg-light p-3 border rounded">
            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
            <div class="px-3">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('single.job', $job->id) }}&quote={{ $job->job_title }}" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
            <a href="https://twitter.com/intent/tweet?text={{ $job->job_title }}&url={{ route('single.job', $job->id) }}" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('single.job', $job->id) }}" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
            </div>
        </div>

        </div>
    </div>
    </div>
</section>

<section class="site-section" id="next">
    <div class="container">

    <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
        <h2 class="section-title mb-2">{{ $relatedJobsCount }} Related Jobs</h2>
        </div>
    </div>
    
    <ul class="job-listings mb-5">
        
        @foreach ($relatedJobs as $job)
            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="{{ route('single.job', $job->id) }}"></a>
            <div class="job-listing-logo">
                <img src="{{ asset('assets/images/' . $job->image . '') }}" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>{{ $job->job_title }}</h2>
                <strong>{{ $job->company }}</strong>
                </div>
                <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> {{ $job->job_region }}
                </div>
                <div class="job-listing-meta">
                <span class="badge badge-danger">{{ $job->job_type }}</span>
                </div>
            </div>
            
            </li>
        @endforeach
        
    </ul>

    </div>
</section>


<!--<section class="bg-light pt-5 testimony-full">
    
    <div class="owl-carousel single-carousel">

    
        <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center text-center text-lg-left">
            <blockquote>
                <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                <p><cite> &mdash; Corey Woods, @Dribbble</cite></p>
            </blockquote>
            </div>
            <div class="col-lg-6 align-self-end text-center text-lg-right">
            <img src="{{ asset('assets/images/person_transparent_2.png') }}" alt="Image" class="img-fluid mb-0">
            </div>
        </div>
        </div>

        <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center text-center text-lg-left">
            <blockquote>
                <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                <p><cite> &mdash; Chris Peters, @Google</cite></p>
            </blockquote>
            </div>
            <div class="col-lg-6 align-self-end text-center text-lg-right">
            <img src="{{ asset('assets/images/person_transparent.png') }}" alt="Image" class="img-fluid mb-0">
            </div>
        </div>
        </div>

    </div>

</section> -->

<!--<section class="pt-5 bg-image overlay-primary fixed overlay" style="background-image: url({{ asset('assets/images/hero_1.jpg') }});">
    <div class="container">
    <div class="row">
        <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
        <h2 class="text-white">Get The Mobile Apps</h2>
        <p class="mb-5 lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
        <p class="mb-0">
            <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>App Store</a>
            <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-android mr-3"></span>Play Store</a>
        </p>
        </div>
        <div class="col-md-6 ml-auto align-self-end">
        <img src="{{ asset('assets/images/apps.png') }}" alt="Image" class="img-fluid">
        </div>
    </div>
    </div>
</section> -->



@endsection