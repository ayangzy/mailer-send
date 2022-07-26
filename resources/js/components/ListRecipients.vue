<template>
  <div class="container mt-4">
    <div class="col-md-12 bg-secondary">
      <div class="card shadow rounded">
        <div class="card-body">
          <h5 class="card-title">Recipient List</h5>
          <form>
            <div class="form-control">
              <input
                type="search"
                class="form-control"
                placeholder="search..."
              />
            </div>
          </form>
          <div class="table-responsive mt-2">
            <table id="add-row" class="display table table-striped table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Recipient</th>
                </tr>
              </thead>

              <tbody v-for="(recipient, index) in recipients" :key="index">
                <tr>
                  <td>{{ index + 1 }}</td>
                  <td>{{ recipient.to }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import {defineComponent, onMounted, ref} from 'vue';
import {useRoute} from 'vue-router';

export default defineComponent({
  setup() {
    const route = useRoute();
    const recipients = ref([]);

    onMounted(async () => {
      if(route.params.id) {
        console.log(route.params.id)
        let response = await axios.get(`/api/v1/emails/${route.params.id}/recipients`);
        recipients.value = response.data.data.data;
        console.log(response.data.data);
      }
    });

    return {
        recipients
    }

  }
})
</script>