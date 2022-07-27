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
              </div>
              <div class="email-compose-fields">
                <form >
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
                  <div
                    class="form-group row"
                    v-for="(item, index) in recipients"
                    :key="index"
                  >
                    <label :for="`to-${index}`" class="col-form-label col-md-1"
                      >To :</label
                    >
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        :placeholder="item.text"
                        v-model="item.value"
                      />
                    </div>
                    <div
                      class="col-md-2"
                      v-if="index === Object.keys(recipients).length - 1"
                    >
                      <button
                        @click.prevent="onAddNewRecipient"
                        class="btn btn-primary btn-block, w-100"
                      >
                        Add
                      </button>
                    </div>
                    <div class="col-md-2" v-else>
                      <button
                        @click.prevent="onRemoveRecipient(index)"
                        class="btn btn-warning btn-block, w-100"
                      >
                        Remove
                      </button>
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
                      <input
                        type="file"
                        class="form-control"
                        clearable="true" 
                        @change="handleImageSelected"
                        multiple
                      />
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
import { ref, reactive, onMounted } from "@vue/runtime-core";
import axios from "axios";
import Swal from "sweetalert2";
export default {
  setup() {
    const errors = ref([]);
    let fileUrls = ref([]);
    const form = reactive({
      from: "",
      recipient: [],
      subject: "",
      text_content: "",
      html_content: "",
      file: [],
    });
    const recipients = ref([]);
    const sendEmail = async () => {
      if (recipients.value.length === 0) return;
      recipients.value.forEach((item) => {
        if (item.value === "") return;
      });
     
      form.recipient = recipients.value.map((item) => {
        return { to: item.value };
      });
     
      try {
        const response = await axios.post("/api/v1/emails/send", form);
        if (response.data.statusCode === 200) {
          Swal.fire({
            icon: "success",
            title: `${response.data.message}`,
            showConfirmButton: false,
            timer: 3000,
          });
        }
        clearFields();
      } catch (e) {
        if (e.response.status === 422) {
          Swal.fire({
            icon: "error",
            title: `${e.response.data.message}`,
            text: "Kindly fill all the fields",
          });
        }
      }
     
    };
   
    const onAddNewRecipient = () => {
      recipients.value.push({ text: "to", value: "" });
    };
    const onRemoveRecipient = (indexPosition) => {
      recipients.value = recipients.value.filter(
        (item, index) => index !== indexPosition
      );
    };
    onMounted(() => {
      recipients.value.push({ text: "to", value: "" });
    });

    const handleImageSelected = (event) => {
      Array.prototype.forEach.call(event.target.files, (file) => {
        form.file.push(file);
      });
    };

    const clearFields = () => {
      form.from = "";
      form.recipient = [""];
      form.subject = "";
      form.text_content = "";
      form.html_content = "";
      form.file = [""];
    };

    return {
      form,
      errors,
      sendEmail,
      recipients,
      onAddNewRecipient,
      onRemoveRecipient,
      handleImageSelected,
      fileUrls,
      clearFields,
    };
  },
};
</script>