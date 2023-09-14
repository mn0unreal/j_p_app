@extends('layouts.app')
<style>
    .code {
        color: #dc143c;
        background-color: #f1f1f1;
        padding-left: 4px;
        padding-right: 4px;
        margin: 0.5rem;
        letter-spacing: -1px;
        display: inline-block;
        border: 1px solid rgba(0,0,0,.25);
    }

    /* Add a vertical line in the middle */
    .vertical-line {
        border-left: 1px solid #ccc;
        height: 100%;
        position: absolute;
        left: 50%;
        top: 0;
        margin-left: -1px; /* Half the width of the line */
    }

    /* Adjust spacing and alignment */
    .card-body {
        position: relative;
    }

    .form-group {
        margin-bottom: 30px;
    }

    /* Style the email and password tables */
    .email-table, .password-table {
        display: inline-block;
        width: 45%; /* Adjust the width as needed */
        vertical-align: top;
    }

    /* Center align the text in the tables */
    .email-table div, .password-table div {
        text-align: center;
    }

</style>
@section('content')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">

        <div class="col-md-6">
        @include('message')
            <div class="card shadow-lg">
                <div class="card-header">login</div>
                <form action="{{route('login.post')}}" method="post"> @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                            @if($errors->has('email'))
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                            @if($errors->has('password'))
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card shadow-lg">
                <div class="card-header">For <b>Seeker</b> testing login <b>click to copy</b></div>
                <div class="card-body ">
                    <div class="vertical-line"></div> <!-- Vertical line in the middle -->
                    <div class="email-table">
                        <div class="form-group">
                            <label for="">Email</label>
                            <div class="code copyable" onclick="copyTagContent(this)">mahmoud@m.com</div>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <div class="code copyable" onclick="copyTagContent(this)">ahmed@a.com</div>
                        </div>
                    </div>
                    <div class="password-table">
                        <div class="form-group">
{{--                            <label for="">Password</label>--}}
{{--                            <div class="code copyable" onclick="copyTagContent(this)">12345678</div>--}}
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="code copyable" onclick="copyTagContent(this)">12345678</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="vertical-line"></div> <!-- Vertical line in the middle -->
                    For <b>employer</b> testing login
                    <hr> <!-- Horizontal line after "employer" -->
                    <div class="email-table">
                        <div class="form-group">
                            <label for="">Email</label>
                            <div class="code copyable" onclick="copyTagContent(this)">hostgator@mailinator.com</div>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <div class="code copyable" onclick="copyTagContent(this)">godaddy@mailinator.com</div>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <div class="code copyable" onclick="copyTagContent(this)">bluehost@mailinator.com</div>
                        </div>
                    </div>
                    <div class="password-table">
                        <div class="form-group">
{{--                            <label for="">Password</label>--}}
{{--                            <div class="code copyable" onclick="copyTagContent(this)">12345678</div>--}}
                        </div>
                        <div class="form-group">
{{--                            <label for="">Password</label>--}}
{{--                            <div class="code copyable" onclick="copyTagContent(this)">12345678</div>--}}
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="code copyable" onclick="copyTagContent(this)">12345678</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyTagContent(element) {
        // Create a new textarea element to hold the tag's content
        const tempInput = document.createElement('textarea');
        tempInput.value = element.innerHTML;

        // Append the textarea to the document
        document.body.appendChild(tempInput);

        // Select and copy the content
        tempInput.select();
        document.execCommand('copy');

        // Remove the temporary textarea
        document.body.removeChild(tempInput);

        // Optionally, provide some visual feedback
        element.style.backgroundColor = 'yellow';
        setTimeout(() => {
            element.style.backgroundColor = ''; // Reset the background color
        }, 2000); // Reset the background color after 1 second (optional)
    }
</script>
@endsection
