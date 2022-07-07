const flashdata = $('#flash-data').data('flashdata');

$(function () {
  $('.deleteConfirm').on('click', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3461ff',
      cancelButtonColor: '#d33'
    }).then((result) => {
      if (result.isConfirmed) {
        $(this).parent('form').submit();
      }
    })
  });
});

$(function () {
  $('.confirmAlert').on('click', function (e) {
    const url = $(this).attr('href');
    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3461ff',
      cancelButtonColor: '#d33'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    })
  });
});

if (flashdata) {
  // Access Denied
  if (flashdata == 'Access Denied') {
    Swal.fire({
      icon: 'error',
      title: flashdata,
      text: "You cannot do this action!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Sign Up Success
  if (flashdata == 'Sign Up Success') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: 'Thank you for signing up!',
      confirmButtonColor: '#3461ff',
      confirmButtonText: 'Sign in now!'
    })
  }
  // Not Verified
  if (flashdata == 'Not Verified') {
    Swal.fire({
      icon: 'error',
      title: flashdata,
      text: 'Please contact the administrator!',
      confirmButtonColor: '#3461ff'
    })
  }
  // Sign In Failed
  if (flashdata == 'Sign In Failed') {
    Swal.fire({
      icon: 'error',
      title: flashdata,
      text: 'Please try again with your account!',
      confirmButtonColor: '#3461ff',
      confirmButtonText: 'Try again!'
    })
  }
  // Sign In Success
  if (flashdata == 'Sign In Success') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: 'Welcome back to E-Report App!',
      confirmButtonColor: '#3461ff',
      confirmButtonText: 'Thank you!'
    })
  }
  // Logout Success
  if (flashdata == 'Logout Success') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: 'Thank you and see you again!',
      confirmButtonColor: '#3461ff',
      confirmButtonText: 'Thank you!'
    })
  }
  // User updated
  if (flashdata == 'User updated') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: 'Thank you for updating the user!',
      confirmButtonColor: '#3461ff'
    })
  }
  // User deleted
  if (flashdata == 'User deleted') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "The user has been deleted!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Password reset!
  if (flashdata == 'Password reset!') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "Don't forget to contact the user!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Profile updated
  if (flashdata == 'Profile updated') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "Your profile has been updated!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Password changed
  if (flashdata == 'Password changed') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "Your password has been changed!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Failed to submit
  if (flashdata == 'Failed to submit') {
    Swal.fire({
      icon: 'error',
      title: flashdata,
      text: "Fill the form correctly and try again!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Project Added
  if (flashdata == 'Project Added') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "Check the project that you added!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Project Updated
  if (flashdata == 'Project Updated') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "Check the project that you updated!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Project Deleted
  if (flashdata == 'Project Deleted') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "The project has been deleted!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Project Finished
  if (flashdata == 'Project Finished') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "The project has been finished!",
      confirmButtonColor: '#3461ff'
    })
  }
  // Project Assigned
  if (flashdata == 'Project Assigned') {
    Swal.fire({
      icon: 'success',
      title: flashdata,
      text: "The project assigned to Project Manager!",
      confirmButtonColor: '#3461ff'
    })
  }
}