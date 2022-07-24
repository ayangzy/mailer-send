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
                  <th>Sender</th>
                  <th>Recipient</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>1</td>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                </tr>

                <tr>
                  <td>2</td>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
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