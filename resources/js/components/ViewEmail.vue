<template>
  <div class="container mt-3">
    <div class="col-md-12">
      <div class="card shadow rounded">
        <div class="card-body">
            <div class="card-title">  <h2>Email detail</h2></div>
          <div class="card">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><h5 class="text-bold"> Email: </h5> {{ email.from }}</li>
              <li class="list-group-item"> <h5 class="text-bold">Subject:</h5> {{ email.subject }}</li>
              <li class="list-group-item"><h5 class="text-bold">Text Content:</h5> {{ email.text_content }}</li>
              <li class="list-group-item"><h5 class="text-bold">Html Content: </h5>{{ email.html_content }}</li>
            </ul>
          </div>
        
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { defineComponent, onMounted, ref } from "vue";
import { useRoute } from "vue-router";

export default defineComponent({
  setup() {
    const route = useRoute();
    const email = ref({});

    onMounted(async () => {
      if (route.params.id) {
        console.log(route.params.id);
        let response = await axios.get(`/api/v1/emails/${route.params.id}`);
        email.value = response.data.data;
        console.log(response);
      }
    });

    return {
      email,
    };
  },
});
</script>