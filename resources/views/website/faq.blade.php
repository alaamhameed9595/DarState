@extends('layouts.website')
@section('title', 'Blog')
@section('styles')
@endsection
@section('content')


    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img" style="background-image:  url('assets/website/img/bg-img/hero1.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h3 class="breadcumb-title">Frequently Quetions & Answers</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->
    <!-- ##### Accordians ##### -->
    <section class="elements-area section-padding-100-0">
        <div class="container">
        <div class="col-12 col-lg-12">
            <div class="accordions mb-100" id="accordion" role="tablist" aria-multiselectable="true">
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6><a role="button" class="" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">How do I list my property with DarState?
                        <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                    </a></h6>
                    <div id="collapseOne" class="accordion-content collapse show">
                        <p>You can list your property by registering an account and submitting your property details through our website, or by contacting our team directly for assistance.</p>
                    </div>
                </div>
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseTwo" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
                            What documents are required to buy or rent a property?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseTwo" class="accordion-content collapse">
                        <p>Typically, you will need a valid ID, proof of income, and in some cases, a residency permit. Our agents will guide you through the specific requirements for your transaction.</p>
                    </div>
                </div>
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseThree" data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
                            How can I schedule a property viewing?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseThree" class="accordion-content collapse">
                        <p>You can schedule a viewing by contacting us via phone, email, or through the property page on our website. We will arrange a convenient time for you.</p>
                    </div>
                </div>
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseFour" data-parent="#accordion" data-toggle="collapse" href="#collapseFour">
                            Does DarState offer property management services?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseFour" class="accordion-content collapse">
                        <p>Yes, we offer comprehensive property management services including tenant screening, rent collection, and maintenance coordination.</p>
                    </div>
                </div>
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseFive" data-parent="#accordion" data-toggle="collapse" href="#collapseFive">
                            How do I contact DarState for support?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseFive" class="accordion-content collapse">
                        <p>You can reach us via our <a href="{{ route('website.contact') }}">Contact page</a>, by phone at +971 5060 74002, or by email at contact@darstate.com.</p>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="accordions mb-100" id="accordion" role="tablist" aria-multiselectable="true">
               
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseSix"
                            data-parent="#accordion" data-toggle="collapse" href="#collapseSix">
                            Can foreigners buy property in the UAE?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseSix" class="accordion-content collapse">
                        <p>Yes, foreigners can buy property in designated freehold areas in the UAE. Our agents can guide you
                            through the process and available locations.</p>
                    </div>
                </div>
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseSeven"
                            data-parent="#accordion" data-toggle="collapse" href="#collapseSeven">
                            What are the costs involved in buying a property?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseSeven" class="accordion-content collapse">
                        <p>Costs typically include the property price, registration fees, agency commission, and sometimes
                            service charges. We provide a full breakdown before you proceed.</p>
                    </div>
                </div>
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseEight"
                            data-parent="#accordion" data-toggle="collapse" href="#collapseEight">
                            How long does it take to complete a property purchase?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseEight" class="accordion-content collapse">
                        <p>The process can take from a few days to several weeks, depending on the property type, financing, and
                            documentation. Our team will keep you updated at every step.</p>
                    </div>
                </div>
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseNine"
                            data-parent="#accordion" data-toggle="collapse" href="#collapseNine">
                            Do you assist with property financing or mortgages?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseNine" class="accordion-content collapse">
                        <p>Yes, we can connect you with trusted banks and mortgage advisors to help you find the best financing
                            options for your needs.</p>
                    </div>
                </div>
                <!-- single accordian area -->
                <div class="panel single-accordion">
                    <h6>
                        <a role="button" class="collapsed" aria-expanded="false" aria-controls="collapseTen"
                            data-parent="#accordion" data-toggle="collapse" href="#collapseTen">
                            What should I do if I want to sell my property?
                            <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        </a>
                    </h6>
                    <div id="collapseTen" class="accordion-content collapse">
                        <p>Contact us to arrange a property valuation and discuss your goals. We will market your property,
                            handle inquiries, and guide you through the selling process.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
@section('scripts')
@endsection
