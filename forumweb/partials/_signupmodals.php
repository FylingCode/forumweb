<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" >
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">SignUp to iDiscuss</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/forumweb/partials/handlesignup.php" method="post">
          <div class="mb-3">
            <label for="signupemail" class="form-label">Enter Your Email</label>
            <input type="email" class="form-control" id="signupemail" name="signupemail" minlength="6" maxlength="30">
            <!-- <input type="email" class="form-control" id="signupemail" name="signupemail"> -->
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="signuppass" class="form-label">Password</label>
            <input type="password" class="form-control" id="signuppass" name="signuppass" minlength="6" maxlength="15">
          </div>
          <div class="mb-3">
            <label for="cpass" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpass" name="cpass" minlength="6" maxlength="15">
          </div>
          <button type="submit" class="btn btn-primary">Sign Up</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>