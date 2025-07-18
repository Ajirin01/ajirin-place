@extends('layouts.site_base')
@section('content')
    <!-- contact area start -->
    <div class="contact-area pb-34 pt-40 pb-md-18 pb-sm-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-message">
                        <h2>Make Enquiries</h2>
                        <form id="contact-form" action="{{ route('sendMessage') }}" method="post" class="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="name" placeholder="Name *" type="text" required>    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="phone" placeholder="Phone " type="text">   
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="email" placeholder="Email *" type="text" required>    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="Subject" placeholder="Subject *" type="text" value="Enquiry">   
                                </div>
                            <div class="col-12">
                                    <div class="contact2-textarea text-center">
                                        <textarea placeholder="Message *" name="message"  class="form-control2" required=""></textarea>     
                                    </div>   
                                    <div class="contact-btn">
                                        <button class="sqr-btn" type="submit">Send Message</button> 
                                    </div> 
                                </div> 
                                <div class="col-12 d-flex justify-content-center">
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                        </form>    
                    </div> 
                </div>
                <div class="col-lg-6">
                    <div class="contact-info mt-md-28 mt-sm-28">
                        <h2>contact us</h2>
                        <p>Phase Two pharmacy Limited was founded in 2013 in the city of Asaba, Minna and other parts of the country.<br><br>
                            
                            Phase Two Pharmacy exist to meet the pharmaceutical needs of individuals, families and other organizations. We have been at the forefront of innovative medicine deliveries to enhance the wellbeing of the health of Nigerians. <br><br>
                            
                            With our Pharmaceutical innovations you can now purchase drugs online and get the drugs delivered right at your domain. 
                            
                            When it comes to innovations in the pharmaceutical industry, we have no match.</p>
                        <ul>
                            <li><i class="fa fa-fax"></i> Address : No. 224 Nnebisi Road, Asaba</li>
                            <li><i class="fa fa-envelope-o"></i> info@yourdomain.com</li>
                            <li><i class="fa fa-phone"></i> phase2 phone number</li>
                        </ul>
                        <div class="working-time">
                            <h3>Working hours</h3>
                            <p><span>Monday – Saturday:</span>08AM – 22PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->

    <!-- map area start -->
    <div class="map-area-wrapper">
        <div class="container">
                <div id="map_content" data-lat="23.763491" data-lng="90.431167" data-zoom="8" data-maptitle="HasTech" data-mapaddress="Floor# 4, House# 5, Block# C     </br> Banasree Main Rd, Dhaka">
                </div>
        </div>
    </div>
    <!-- map area end -->
@endsection