<div class="border-top h-100 position-sticky">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 pt-4 text-muted text-center">
                        <p>This application is designed and developed by {{ dev_name() }}</p>
                        <p>
                            <a href="{{url('/about')}}" class="mr-2">About</a>
                            <a href="{{url('/terms-of-use')}}" class="mr-2">Terms of Use</a>
                            <a href="{{url('/contact')}}">Contact</a>
                        </p>
                        <p>Tutor Finder &copy; {{date('Y')}}</p>
                    </div>
                </div>
            </div>
        </div>