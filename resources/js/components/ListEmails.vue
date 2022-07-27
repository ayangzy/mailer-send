<template>
  <div class="container mt-4">
    <div class="col-md-12 bg-secondary">
      <div class="card shadow rounded">
        <div class="card-body">
          <h5 class="card-title">Mail list</h5>
          <form>
            <div class="form-control">
              <input
                type="search"
                class="form-control"
                placeholder="search..."
                v-model="searchValue"
              />
            </div>
          </form>
          <div class="table-responsive mt-2">
            <table id="add-row" class="display table table-striped table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Sender</th>
                  <th>Subject</th>
                  <th>Status</th>
                  <th style="width: 10%">Action</th>
                </tr>
              </thead>
              <tbody v-if="emails && emails.length > 0">
                <tr v-for="(email, index) in filteredEmails" :key="index">
                  <td>{{ index + 1 }}</td>
                  <td>{{ email.from }}</td>
                  <td>{{ email.subject }}</td>
                  <td v-if="email.status === 'sent'">
                    <button class="btn btn-success btn-round btn-xs">
                      {{ email.status }}
                    </button>
                  </td>
                  <td v-else>
                    <button class="btn btn-primary btn-round btn-xs">
                      {{ email.status }}
                    </button>
                  </td>
                  <td>
                    <div class="form-button-action">
                      <button type="button" class="btn btn-info btn-sm">
                        <router-link
                          :to="`/view-email/${email.id}`"
                          class="btn btn-info btn-sm"
                        >
                          view email
                        </router-link>
                      </button>
                      &nbsp;
                      <button class="btn btn-primary btn-sm">
                        <router-link
                          :to="`/list-recipients/${email.id}`"
                          class="btn-primary btn-sm"
                        >
                          view recipients
                        </router-link>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td class="text-center" colspan="3">No record found.</td>
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
import { onMounted, ref, computed } from "@vue/runtime-core";
import axios from "axios";
export default {
  setup() {
    const emails = ref([]);
    const searchValue = ref("");
    const getEmail = async (page) => {
      let res = await axios.get("/api/v1/emails?page=" + page);
      emails.value = res.data.data.data;
    };
    const filteredEmails = computed(() =>
      emails.value.filter(
        (item) =>
          item.from.toLowerCase().includes(searchValue.value.toLowerCase()) ||
          item.subject.toLowerCase().includes(searchValue.value.toLowerCase())
      )
    );
    onMounted(getEmail());
    return {
      emails,
      searchValue,
      filteredEmails,
    };
  },
};
</script>