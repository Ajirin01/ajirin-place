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
                        <h2>Contact Us</h2>
                        <p>
                        <strong>Ajirin Place</strong> is a modern creative studio offering elegant, handcrafted art, premium custom frames, and refined woodcrafts, all <em>made for places that matter</em>. We help discerning individuals and brands transform their spaces with sophisticated, meaningful pieces that reflect quality and style.<br><br>

                        Rooted in craftsmanship and inspired by contemporary design, Ajirin Place delivers timeless works that add warmth, personality, and distinction to any environment, from homes and offices to upscale commercial interiors. Every piece is thoughtfully made to elevate the everyday.<br><br>

                        Connect with us to explore bespoke commissions, curated collections, or collaborative design solutions that bring your vision to life with grace and artistry.
                        </p>


                        <ul>
                            <li><i class="fa fa-fax"></i> Address : Opp Mayfair Pharmacy, Ile-Ife, Osun State, Nigeria</li>
                            <li><i class="fa fa-envelope-o"></i> info@ajirinplace.com</li>
                            <li><i class="fa fa-phone"></i> +234 705 850 8448</li>
                        </ul>
                        <div class="working-time">
                            <h3>Working hours</h3>
                            <p><span>Monday – Saturday:</span>10AM – 17PM</p>
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