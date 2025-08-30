<!DOCTYPE html>
<html lang="en">
    @include('websitecontent::websites.plp.layouts.header')

    <div class="wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>

    @include('websitecontent::websites.plp.layouts.footer')
</html>