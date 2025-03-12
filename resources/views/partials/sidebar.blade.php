

      @if(auth()->check() && auth()->user()->role === 'Admin'  && auth()->user()->status == '1')
<div class="sidebar closed">
    <div class="sidebar-content-container">
        <div class="sidebar-content">
            <div class="profile">
@if(auth()->user()->profile_picture)
        <a href="{{ route('dashboard.users.show', auth()->user()->id) }}">
            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile">
        </a>
    @else
        <div class="default-profile-picture"><a href="{{ route('dashboard.users.show', auth()->user()->id) }}">
            <i class="fas fa-user"></i></a>
        </div>
    @endif
                <h3>

                  
                                    {{auth()->user()->user_name}}    
              
                </h3>  
                
          
            </div>
            <ul class="menu">
                <!-- Links for other components -->


<li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
    <a href="{{ route('dashboard.index') }}">
<i class="fas fa-tachometer-alt menu-icon"></i>
       لوحة التحكم 
        </a>
</li>

         <li class="menu-item {{ request()->is('dashboard/users*') ? 'active' : '' }}">
    <a href="{{ route('dashboard.users.index') }}">
        <i class="fas fa-users menu-icon"></i> المستخدمين
    </a>
</li>
         <li class="menu-item {{ request()->is('students*') ? 'active' : '' }}">
    <a href="{{ route('students.index') }}">
      
     <i class="fas fa-user-graduate menu-icon"></i>    الطلاب
    </a>
</li>
         <li class="menu-item {{ request()->is('teachers*') ? 'active' : '' }}">
    <a href="{{ route('teachers.index') }}">
<i class="fas fa-chalkboard-teacher menu-icon"></i>      المعلمين
    </a>
</li>
         <li class="menu-item {{ request()->is('subjects*') ? 'active' : '' }}">
    <a href="{{ route('subjects.index') }}">
<i class="fas fa-book menu-icon"></i> 
        المواد الدراسية
    </a>
</li>
         <li class="menu-item {{ request()->is('academic_classes*') ? 'active' : '' }}">
    <a href="{{ route('academic_classes.index') }}">
<i class="fas fa-graduation-cap menu-icon"></i>   الصفوف الأكاديمية
    </a>
</li>
         <li class="menu-item {{ request()->is('schedules*') ? 'active' : '' }}">
    <a href="{{ route('schedules.index') }}">
        <i class="fas fa-calendar-alt menu-icon"></i>
        الجداول
    </a>
</li>
         <li class="menu-item {{ request()->is('guardians*') ? 'active' : '' }}">
    <a href="{{ route('guardians.index') }}">
<i class="fas fa-user-shield menu-icon"></i>
        اولياء الامور
    </a>
</li>
         <li class="menu-item {{ request()->is('assignments*') ? 'active' : '' }}">
    <a href="{{ route('assignments.index') }}">
<i class="fas fa-tasks menu-icon"></i>
        
        
        الواجبات الدراسية
    </a>
</li>
         <li class="menu-item {{ request()->is('attendances*') ? 'active' : '' }}">
    <a href="{{ route('attendances.index') }}">
<i class="fas fa-chalkboard-teacher menu-icon"></i>   الحضور
    </a>
</li>
         <li class="menu-item {{ request()->is('grades*') ? 'active' : '' }}">
    <a href="{{ route('grades.index') }}">
            <i class="fas fa-graduation-cap menu-icon"></i>  الدرجات
    </a>
</li>
         <li class="menu-item {{ request()->is('events*') ? 'active' : '' }}">
    <a href="{{ route('events.index') }}">
<i class="fas fa-calendar-day menu-icon"></i> الأحداث

    </a>
</li>
         <li class="menu-item {{ request()->is('#') ? 'active' : '' }}">
<a href="{{ route('settings.edit') }}">
    <!-- Add your icon or text for settings here -->

        <i class="fas fa-cog menu-icon"></i> الإعدادات
    </a>
</li>

           <li class="menu-item">
                <a href="#" onclick="logoutWithConfirmation()">
                    <i class="fas fa-sign-out-alt menu-icon"></i> تسجيل الخروج
                </a>
            </li>
          
            </ul>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
        </div>
    </div>
    <div class="sidebar-toggle" onclick="toggleSidebar()">&#9776;</div>
</div>
   


@elseif(auth()->check() && auth()->user()->role === 'Teacher'  && auth()->user()->status == '1')

<div class="sidebar closed">
    <div class="sidebar-content-container">
        <div class="sidebar-content">
                  <div class="profile">
@if(auth()->user()->profile_picture)
        <a href="{{ route('dashboard.users.show', auth()->user()->id) }}">
            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile">
        </a>
    @else
        <div class="default-profile-picture"><a href="{{ route('dashboard.users.show', auth()->user()->id) }}">
            <i class="fas fa-user"></i></a>
        </div>
    @endif
                <h3>

                  
                                    {{auth()->user()->user_name}}    
              
                </h3>  
                
              
            </div>
            <ul class="menu">
                <!-- Links for other components -->


<li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
    <a href="{{ route('dashboard.index') }}">
<i class="fas fa-tachometer-alt menu-icon"></i>
       لوحة التحكم 
        </a>
</li>
  <li class="menu-item {{ request()->is('schedules*') ? 'active' : '' }}">
    <a href="{{ route('schedules.index') }}">
        <i class="fas fa-calendar-alt menu-icon"></i>
        الجداول
    </a>
</li>

         <li class="menu-item {{ request()->is('assignments*') ? 'active' : '' }}">
    <a href="{{ route('assignments.index') }}">
<i class="fas fa-tasks menu-icon"></i>
        
        
        الواجبات الدراسية
    </a>
</li>



         <li class="menu-item {{ request()->is('events*') ? 'active' : '' }}">
    <a href="{{ route('events.index') }}">
<i class="fas fa-calendar-day menu-icon"></i> الأحداث

    </a>
</li>



         <li class="menu-item {{ request()->is('#') ? 'active' : '' }}">
<a href="{{ route('settings.edit') }}">
    <!-- Add your icon or text for settings here -->

        <i class="fas fa-cog menu-icon"></i> الإعدادات
    </a>
</li>

           <li class="menu-item">
                <a href="#" onclick="logoutWithConfirmation()">
                    <i class="fas fa-sign-out-alt menu-icon"></i> تسجيل الخروج
                </a>
            </li>
            </ul>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
        </div>
    </div>
    <div class="sidebar-toggle" onclick="toggleSidebar()">&#9776;</div>
</div>
   
@elseif(auth()->check() && auth()->user()->role === 'Student' && auth()->user()->status == '1')

<div class="sidebar closed">
    <div class="sidebar-content-container">
        <div class="sidebar-content">
          <div class="profile">
@if(auth()->user()->profile_picture)
        <a href="{{ route('dashboard.users.show', auth()->user()->id) }}">
            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile">
        </a>
    @else
        <div class="default-profile-picture"><a href="{{ route('dashboard.users.show', auth()->user()->id) }}">
            <i class="fas fa-user"></i></a>
        </div>
    @endif
                <h3>

                  
                                    {{auth()->user()->user_name}}    
              
                </h3>  
                
            
            </div>
            <ul class="menu">
                <!-- Links for other components -->


<li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
    <a href="{{ route('dashboard.index') }}">
<i class="fas fa-tachometer-alt menu-icon"></i>
       لوحة التحكم 
        </a>
</li>
  <li class="menu-item {{ request()->is('schedules*') ? 'active' : '' }}">
    <a href="{{ route('schedules.index') }}">
        <i class="fas fa-calendar-alt menu-icon"></i>
        الجداول
    </a>
</li>

         <li class="menu-item {{ request()->is('assignments*') ? 'active' : '' }}">
    <a href="{{ route('assignments.index') }}">
<i class="fas fa-tasks menu-icon"></i>
        
        
        الواجبات الدراسية
    </a>
</li>



@if(auth()->user()->student)
         <li class="menu-item {{ request()->is('students*') ? 'active' : '' }}">
   <a href="{{ route('students.show_grades', ['student_id' => auth()->user()->student->id]) }}">
<i class="fas fa-user-graduate menu-icon"></i>
        
        عرض درجاتي
    </a>
</li>
         <li class="menu-item {{ request()->is('academic_classes*') ? 'active' : '' }}">
<a href="{{ route('academic_classes.show_attendances', ['academic_class_id' => auth()->user()->student->academic_classes_id, 'date' => $date ?? '']) }}">
<i class="fas fa-chalkboard-teacher menu-icon"></i>
        
        عرض الحضور
    </a>
</li>


@endif


    
         <li class="menu-item {{ request()->is('events*') ? 'active' : '' }}">
    <a href="{{ route('events.index') }}">
<i class="fas fa-calendar-day menu-icon"></i> الأحداث

    </a>
</li>




         <li class="menu-item {{ request()->is('#') ? 'active' : '' }}">
<a href="{{ route('settings.edit') }}">
    <!-- Add your icon or text for settings here -->

        <i class="fas fa-cog menu-icon"></i> الإعدادات
    </a>
</li>

           <li class="menu-item">
                <a href="#" onclick="logoutWithConfirmation()">
                    <i class="fas fa-sign-out-alt menu-icon"></i> تسجيل الخروج
                </a>
            </li>
            </ul>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
        </div>
    </div>
    <div class="sidebar-toggle" onclick="toggleSidebar()">&#9776;</div>
</div>
   
@endif

<script>




    function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    
    if (sidebar.classList.contains('closed')) {
        // Open the sidebar
        sidebar.classList.remove('closed');
        sidebar.style.left = '0'; // Move sidebar to the left edge
        sidebarToggle.style.left = '250px'; // Move toggle button to the right
    } else {
        // Close the sidebar
        sidebar.classList.add('closed');
        sidebar.style.left = '-250px'; // Move sidebar off-screen to the left
        sidebarToggle.style.left = '10px'; // Move toggle button back to the left edge
    }
}


// Add event listener to the document body
document.body.addEventListener('click', function(event) {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');

    // Check if the clicked element is not inside the sidebar
    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
        // Close the sidebar if it's open
        if (!sidebar.classList.contains('closed')) {
            sidebar.classList.add('closed');
            sidebar.style.left = '-250px'; // Move sidebar off-screen to the left
            sidebarToggle.style.left = '10px'; // Move toggle button back to the left edge
        }
    }
});
    function logoutWithConfirmation() {
        if (confirm("هل أنت متأكد أنك تريد تسجيل الخروج؟")) {
            document.getElementById('logout-form').submit();
        }
    }
</script>