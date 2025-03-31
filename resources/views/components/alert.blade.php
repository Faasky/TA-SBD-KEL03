@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span>{{ session('success') }}</span>
    </div>
    <button class="absolute top-0 right-0 mt-4 mr-4 text-green-700 hover:text-green-900 focus:outline-none" onclick="this.parentElement.remove()">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
    <div class="flex items-center">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <span>{{ session('error') }}</span>
    </div>
    <button class="absolute top-0 right-0 mt-4 mr-4 text-red-700 hover:text-red-900 focus:outline-none" onclick="this.parentElement.remove()">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if(session('warning'))
<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded" role="alert">
    <div class="flex items-center">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <span>{{ session('warning') }}</span>
    </div>
    <button class="absolute top-0 right-0 mt-4 mr-4 text-yellow-700 hover:text-yellow-900 focus:outline-none" onclick="this.parentElement.remove()">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if(session('info'))
<div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded" role="alert">
    <div class="flex items-center">
        <i class="fas fa-info-circle mr-2"></i>
        <span>{{ session('info') }}</span>
    </div>
    <button class="absolute top-0 right-0 mt-4 mr-4 text-blue-700 hover:text-blue-900 focus:outline-none" onclick="this.parentElement.remove()">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if($errors->any())
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
    <div class="flex">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <div>
            <p class="font-bold">Terdapat kesalahan:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button class="absolute top-0 right-0 mt-4 mr-4 text-red-700 hover:text-red-900 focus:outline-none" onclick="this.parentElement.remove()">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif