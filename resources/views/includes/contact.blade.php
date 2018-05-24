<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">@lang('messages.contact.heading')</h2>
                <h3 class="section-subheading">@lang('messages.contact.subheading')</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="contactForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" name="fullname" type="text" placeholder="@lang('messages.contact.fullname')">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="email" type="email" placeholder="@lang('messages.contact.email')">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="phone" type="tel" placeholder="@lang('messages.contact.phoneno')">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="content" placeholder="@lang('messages.contact.content')"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center mt-3">
                        <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="button">@lang('messages.contact.sendbutton')</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>