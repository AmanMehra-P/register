<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Edit</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container my-5">
    <h2>Edit Users</h2>

    <!-- Display any validation errors -->
    <div id="alert-message" class="alert d-none"></div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Edit User:</h5>

            <!-- Edit form -->
            <form id="editForm" data-id="{{ $user->id }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="form-group mb-3">
                    <label for="name_{{ $user->id }}">Name</label>
                    <input type="text" name="name" class="form-control" id="name_{{ $user->id }}" value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email_{{ $user->id }}">Email</label>
                    <input type="email" name="email" class="form-control" id="email_{{ $user->id }}" value="{{ old('email', $user->email) }}" required>
                </div>

                <!-- Gender -->
                <div class="form-group mb-3">
                    <label for="gender_{{ $user->id }}">Gender</label>
                    <select name="gender" class="form-control" id="gender_{{ $user->id }}" required>
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Skill -->
                <div class="form-group mb-3">
                    <label for="skill_{{ $user->id }}">Skill</label>
                    <input type="text" name="skill" class="form-control" id="skill_{{ $user->id }}" value="{{ old('skill', $user->skill) }}">
                </div>

                <!-- Address -->
                <div class="form-group mb-3">
                    <label for="address_{{ $user->id }}">Address</label>
                    <textarea name="address" class="form-control" id="address_{{ $user->id }}">{{ old('address', $user->address) }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="button" class="btn btn-primary" id="updateButton">Update</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $('#updateButton').click(function () {
            // Fetch the user ID and form data
            var userId = $('#editForm').data('id');
            var formData = {
                name: $('#name_' + userId).val(),
                email: $('#email_' + userId).val(),
                gender: $('#gender_' + userId).val(),
                skill: $('#skill_' + userId).val(),
                address: $('#address_' + userId).val(),
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            };

            $.ajax({
                url: "{{ route('user.update',$user->id) }}",
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#alert-message').removeClass('d-none alert-danger').addClass('alert-success').text('User updated successfully!');
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    for (var error in errors) {
                        errorMessage += errors[error][0] + '<br>';
                    }
                    $('#alert-message').removeClass('d-none alert-success').addClass('alert-danger').html(errorMessage);
                }
            });
        });
    });
</script>
</body>
</html>
