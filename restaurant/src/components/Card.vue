<template>
  <div class="card p-5 rounded-md shadow-xl">
    <div class="card-header mb-5">
      <h3 class="font-bold">
        <slot name="card-header" />
      </h3>
    </div>
    <div class="card-body">
      <slot name="card-body" />
    </div>
  </div>
</template>
