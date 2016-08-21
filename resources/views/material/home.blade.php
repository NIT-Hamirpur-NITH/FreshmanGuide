@extends('material.layouts.master')

@section('styles')
  <style>
    h5.description {
      text-align: justify;
      line-height: 1.7em;
    }

    .section-landing > .row > div {
      margin-left: 10%;
      width: 80%;
    }
  </style>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('{{ url('images/front.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="title">Welcome Freshman !</h1>
                <p>
                  If you were here before, I don't know why you are reading this again. <br>
                  If you were not, where were you? Really!! What mountains where you climbing? <br>
                  Anyways now that you are here, you are welcome. And we know why you are here,
                  just click on the button below to begin your journey
                  or maybe read the introduction below if you care.
                </p>
                <br />
                <a href="{{ url('sections') }}" class="btn btn-danger btn-raised btn-lg">
                    <i class="fa fa-play"></i> Start Knowing
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center section-landing">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">About This URL Location</h2>
                    <h5 class="description">
                      Hi, There! <br> <br>
                      There are only three reasons why you could be here: <br />
                      1. You deserve to get into an IIT, but life gave you lemons. Welcome to the best bargain you could’ve wished for.
                         Read why IIT Competition Keeda shouldn't matter anymore and other things you need to know as a freshman, <a href="https://www.quora.com/What-are-some-of-the-things-that-a-freshman-needs-to-know-when-they-enter-into-NIT-Hamirpur" target="_blank">here</a>. <br>
                      2. You thought it snowed in the college, and you have stumbled upon here,
                         by the virtue of you feeling deceived and having nothing better to do. <br>
                      3. You’ve heard about the guide’s pure awesomeness. </br>
                      </br>
                      Whatever the reason, you’ve finally arrived, and that is what matters. Before we go any further check out this map that a computer science student put for you so generously.</br>
                    </h5>

                    {{-- Google Map snippet --}}
                    <div class="section section-landing text-center">
                        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1Fo0vVknWpz1n4QpxGovAOsYaR8U" width="85%" height="600px"></iframe>
                    </div>

                    <h5 class="description">
                      Now, whether we know it or not, each one of us encounters a point in life where we stop, and think the question that mankind has
                      pondered upon ever since learning to make fire – <i>‘What are we doing here? And where are we headed?’</i> <br> <br>
                      In the moments of such deep thought(s), fret not. For the first time in ages, we have put down on paper what has,
                      till now, only been passed as word of mouth. While not intending for it to be a <i>‘Guide to being an NITHian’</i>,
                      if the freshmen were to treat it as such, it would bring tears to the makers’ eyes. <br> <br>
                      Legend tells of a legendary place, in the relatively colder, lower western regions of the legendary Himalayas. <br> <br>
                      Legend has it that this place remained the stuff of legends until 1986 A.D. when it was established
                      as Regional Engineering College, Hamirpur. After that the legend transcended itself, by becoming, ledendary!
                      Since then, many legends have gone through its scenic jungles, dusty laboratories and hallowed halls.
                      And now, these legends bring to you the fastest and the most effective ways to achieve just that – their “legendariness” and saviness.
                      And there's another legend that was created with the creation of this guide: <br> <br>
                      <b>The Legend of The Unknown Creators</b>. It states that one would never know who exactly were/are the persons
                      who worked / work to make this guide a reality.
                      Your backtracking skills could give you rumors, but they would never give you surety.
                      It is our sincere hope that, this guide shall serve as a beacon to all those who come here with curiousity
                      about the legendary <b>'Mirpur</b> and everyone else who has come here for fun. <br> <br>
                    </h5>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
