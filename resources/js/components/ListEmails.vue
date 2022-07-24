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

              <tbody>
                <tr>
                  <td>1</td>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>
                    <div class="form-button-action">
                      <button type="button" class="btn btn-info btn-sm">
                        <router-link to="/view-email">view email</router-link>
                      </button>
                      &nbsp;

                      <button class="btn btn-info btn-sm">
                        <router-link to="/list-recipients">view recipients</router-link>
                      </button>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>2</td>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>
                    <div class="form-button-action">
                      <button type="button" class="btn btn-info btn-sm">
                        view email
                      </button>
                      &nbsp;

                      <button class="btn btn-info btn-sm">
                        view recipients
                      </button>
                    </div>
                  </td>
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
export default {};
</script>