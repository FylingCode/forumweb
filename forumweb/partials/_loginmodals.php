<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" >
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginModalLabel">Login to iDiscuss</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/forumweb/partials/handellogin.php" method="post">
          <div class="mb-3">
            <label for="loginemail" class="form-label">Enter Your Email</label>
            <!-- <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp"> -->
            <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp" minlength="6" maxlength="30">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="loginpass" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginpass" name="loginpass" maxlength="15"> 
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
     
    </div>
  </div>
</div>