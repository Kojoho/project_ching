<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('home') }}
        </h2>
    </x-slot>

    <<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900 dark:text-gray-100">
        <h2>Announcement Headline 1</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod leo ac quam ullamcorper, sit amet hendrerit mauris tincidunt.</p>
        <a href="#" class="text-blue-500 hover:text-blue-700">Read More</a>
        <hr>
        <h2>Announcement Headline 2</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod leo ac quam ullamcorper, sit amet hendrerit mauris tincidunt.</p>
        <a href="#" class="text-blue-500 hover:text-blue-700">Read More</a>
        <hr>
        </div>
    </div>
  </div>
</div>
</x-app-layout>
