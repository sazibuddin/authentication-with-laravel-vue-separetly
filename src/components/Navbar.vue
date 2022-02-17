<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
         <router-link :to="{ name: 'Home' }" class="navbar-brand">
                 Vue-client
             </router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <router-link :to="{ name: 'Users' }" class="nav-link">
                 Users
             </router-link>
        </li>
        <li class="nav-item">
             <router-link :to="{ name: 'Profile' }" class="nav-link">
                 Profile
             </router-link>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Role management
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
                <router-link :to="{ name: 'RoleCreate' }" class="dropdown-item">
                    Create role
                </router-link>
            </li>
            <li>
                <router-link :to="{ name: 'AssignRole' }" class="dropdown-item">
                    Assign role to user
                </router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item">
             <router-link :to="{ name: 'Logout' }" class="nav-link text-danger">
                 Logout
             </router-link>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>

<script>
// @ is an alias to /src

export default {
  name: 'Navbar',
  components: {},
}
</script>
