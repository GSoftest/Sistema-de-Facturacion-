@props(['on'])

<div class="flex justify-end" id='notificacion'>
<div class="px-4 py-3 shadow-md border" role="alert" style="border-radius: 0.375rem;border-top-width: 4px;background-color: rgb(220 252 231);border-color: rgb(134 239 172);width: 20%;">
  <div class="flex">
  <p class="text-sm">{{$on}}</p>
  </div>
</div>
</div>