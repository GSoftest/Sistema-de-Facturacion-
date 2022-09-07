@props(['on'])

<div class="flex justify-end" id='advertencia'>
<div class="px-4 py-3 shadow-md border" role="alert" style="border-radius: 0.375rem;border-top-width: 4px;background-color: rgb(252 229 220);border-color: rgb(215 49 17);width: 20%;">
  <div class="flex">
  <p class="text-sm"><i class="fa-solid fa-exclamation fa-sm" style="color: #ff1e01;" aria-hidden="true"></i>&nbsp;{{$on}}</p>
  </div>
</div>
</div>