const flashdata = $('#flash-data').data('flashdata');

if (flashdata) {
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
}