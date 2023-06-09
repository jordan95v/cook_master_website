@if (session('success'))
    <div class="flex justify-center">
        <div class="alert alert-success shadow-lg max-w-lg">
            <div class="mx-auto text-center">
                <i class="fa-solid fa-circle-check"></i>
                {{ __(session('success')) }}
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="flex justify-center">
        <div class="alert alert-error shadow-lg max-w-lg">
            <div class="mx-auto">
                <i class="fa-solid fa-circle-xmark"></i>
                {{ __(session('error')) }}
            </div>
        </div>
    </div>
@endif
