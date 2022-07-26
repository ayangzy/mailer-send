<template>
  <div class="wrapper sidebar_minimize">
    <div class="main-panel">
      <div class="container container-full">
        <div class="page-inner page-inner-fill">
          <div class="page-with-aside mail-wrapper bg-white">
            <div class="page-aside bg-grey1">
              <div class="aside-header">
                <div class="title">Mailer send</div>
                <div class="description">A simple transaction email app</div>
                <a
                  class="btn btn-primary toggle-email-nav"
                  data-toggle="collapse"
                  href="#email-nav"
                  role="button"
                  aria-expanded="false"
                  aria-controls="email-nav"
                >
                  <span class="btn-label">
                    <i class="icon-menu"></i>
                  </span>
                  Menu
                </a>
              </div>
              <div class="aside-nav collapse" id="email-nav">
                <ul class="nav">
                  <li class="active">
                    <router-link to="/list-emails"
                      ><i class="fa fa-envelope"></i>View Sent Mail</router-link
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="page-content mail-content">
              <div class="email-head d-lg-flex d-block">
                <h3>
                  <i class="flaticon-pen mr-1"></i>
                  Compose new message
                </h3>

                <div class="text-sm text-danger" if="errors != ''">
                  <p v-for="error in errors" class="mb-0" :key="error">
                    <small>{{ error }} </small>
                  </p>
                </div>
              </div>
              <div class="email-compose-fields">
                <form>
                  <div class="form-group row">
                    <label for="to" class="col-form-label col-md-1"
                      >From :</label
                    >
                    <div class="col-md-11">
                      <input
                        type="text"
                        class="form-control"
                        id="to"
                        v-model="form.from"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="to" class="col-form-label col-md-1">To :</label>
                    <div class="col-md-11">
                      <input
                        type="text"
                        class="form-control"
                        id="to"
                        v-model="form.recipient[to]"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="subject" class="col-form-label col-md-1"
                      >Subject :</label
                    >
                    <div class="col-md-11">
                      <input
                        type="text"
                        class="form-control"
                        id="subject"
                        v-model="form.subject"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="subject" class="col-form-label col-md-1"
                      >Text Content :</label
                    >
                    <div class="col-md-11">
                      <textarea
                        v-model="form.text_content"
                        class="form-control"
                        id=""
                        cols="10"
                        rows="4"
                      ></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="subject" class="col-form-label col-md-1"
                      >Html Content :</label
                    >
                    <div class="col-md-11">
                      <textarea
                        v-model="form.html_content"
                        class="form-control"
                        id=""
                        cols="10"
                        rows="4"
                      ></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="subject" class="col-form-label col-md-1"
                      >Attach file(s):
                    </label>
                    <div class="col-md-11">
                      <input type="file" class="form-control" />
                    </div>
                  </div>
                </form>
              </div>
              <div class="email-editor">
                <div id="editor"></div>
                <div class="email-action">
                  <button class="btn btn-primary" @click="sendEmail">
                    Send
                  </button>
                  <button class="btn btn-danger">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { ref, reactive } from "@vue/runtime-core";
import axios from "axios";
export default {
  setup() {
    const errors = ref([]);
    const form = reactive({
      from: "",
      recipient: [],
      subject: "",
      text_content: "",
      html_content: "",
    });

    const sendEmail = async () => {
      try {
        await axios.post("api/v1/emails/send", form);
      } catch (e) {
        if (e.response.status == 422) {
          var data = [];
          for (const key in e.response.data.errors) {
            console.log(response.data.errors);
            data.push(e.response.data.errors[key][0]);
          }
          errors.value = data;
        }
      }
    };

    return {
      form,
      errors,
      sendEmail,
    };
  },
};
</script>