<!-- resources/js/components/UserListComponent.vue -->

<template>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Role</th>
                    <th>Profile Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.user_name }}</td>
                    <td>{{ user.email }}</td>
                 
                    
<td>{{ user.date_of_birth ? user.date_of_birth.format('Y-m-d') : 'N/A' }}</td>

                    <td>{{ user.role }}</td>
                    <td>
                        <profile-picture :picture="user.profile_picture"></profile-picture>
                    </td>
                    <td>
                        <router-link :to="'/dashboard/users/' + user.id" class="btn btn-info btn-sm">View</router-link>
                        <router-link :to="'/dashboard/users/' + user.id + '/edit'" class="btn btn-primary btn-sm">Edit</router-link>
                        {{-- Add delete button if needed --}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['users']
};
</script>
