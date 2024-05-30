@if (session()->has('message'))
    
<div x-data="{show:true}" x-init = "setTimeout(() => show = false , 3000)" x-show='show' class="position-absolute top-0 start-50 translate-middle-x text-light pop-z-index">
    <div class="px-4 pb-4 popup text-center">
        <i class="bi bi-check-circle-fill fs-1"></i>
        <h5 class="my-auto text-center text-uppercase pt-2">
            {{session('message')}}
        </h5>
    </div>
    
</div>
        
    
@endif