<div class="min-h-screen bg-gray-100">
    <div>
        @include('layouts.admin-navigation')
    </div>

      <!-- Page Side bar -->
      <sidebar /> 
      <!-- Page Content -->
      <main>
          {{ $slot }}
      </main>
</div>
