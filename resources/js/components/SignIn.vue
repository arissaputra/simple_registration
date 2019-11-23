<template>
    <div>
        <b-container>
      <b-row class="justify-content-md-center">
        <b-col cols="8" class="mybg">
          <b-form @submit="onSubmit" class="mt-3">
            <label class="mytitle">Login Page</label>
            
          </b-form>
          <router-link to="/">
            <b-button block size="lg" class="mybg-purple mb-3">Back to Registration</b-button>
          </router-link>
        </b-col>
      </b-row>
    </b-container>

    </div>
</template>

<script>
export default {
    
}
</script>

<style>

</style>