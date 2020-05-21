@extends('user.layouts.app')

@section("title", "Contact Us")

@section('content')
<section class="navb-section">
    <div class="container-fluid">
        <!-- Top Menu -->
        @include('user.templates.header')

        <!------- SIgnup Modal  -------->
      @include('user.templates.signup-modal')

      <!------- Pricing Modal  -------->
      @include('user.templates.price-modal')
    </div>
</section>

    <!-- Page Conttent -->
    <main class="about-us-page section-ptb">

        <div class="about-us_area section-pb">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div id="privacy-policy">
                            <h2  class="text-center mt-5"><b>Contact Us</b></h2>
                            
                            <p><span class="num">15</span>. <b>Links to Other Sites</b></p>
                            <p>Our Service may contain links to other sites that are not operated by us. If you click a third party link, you will be directed to that third party’s site. We strongly advise you to review the Privacy Policy of every site you visit.</p>
                            <p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>
                            <p>For example, the outlined Privacy Policy has been created using <a href="https://policymaker.io/">PolicyMaker.io</a>, a free web application for generating high-quality legal documents. PolicyMaker’s online privacy policy generator is an easy-to-use <a href="https://policymaker.io/privacy-policy/">free tool for creating privacy policy template</a> for a website, blog, online store or app.</p>
                            <p><span class="num">16</span>. <b><b>Children’s Privacy</b></b>
                            </p>
                            <p>Our Services are not intended for use by children under the age of 18 (<b>“Child”</b> or <b>“Children”</b>).</p>
                            <p>We do not knowingly collect personally identifiable information from Children under 18. If you become aware that a Child has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from Children without verification of parental consent, we take steps to remove that information from our servers.</p>
                            <p><span class="num">17</span>. <b>Changes to This Privacy Policy</b></p>
                            <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
                            <p>We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update “effective date” at the top of this Privacy Policy.</p>
                            <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
                            <p><span class="num">18</span>. <b>Contact Us</b></p>
                            <p>If you have any questions about this Privacy Policy, please contact us by email: <b><span class="email">support@wazuapp.com</span></b>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!--// Page Conttent -->
@include('user.templates.footer')

@endsection
