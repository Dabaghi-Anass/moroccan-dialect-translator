<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Translator App</title>
      <link rel="stylesheet" href="styles.css">
      <link rel="icon" href="favicon.png" type="image/png">
      <script src="https://cdn.tailwindcss.com"></script>
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
      <script src="translate.js"></script>
      <script src="lightmode.js" defer></script>
      <script src="script.js" defer></script>
  </head>
  <body>
    <header class="bg-[var(--bg-light-clr)] shadow-sm">
        <nav class="container p-4 flex justify-between items-center mx-auto">
          <div class="brand flex items-center gap-2">
            <img src="usa.png" alt="USA Flag" class="w-8 h-8">
            <svg class="icon svg stroke" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8 10H20L16 6" stroke="#0040dd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M16 14L4 14L8 18" stroke="#0040dd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <img src="morocco.png" alt="Morocco Flag" class="w-8 h-8">
          </div>
          <div class="flex flex-col justify-center ml-3">
            <input type="checkbox" name="light-switch" class="light-switch sr-only" id="light-switch" />
            <label class="relative cursor-pointer p-2" for="light-switch">
                <svg class="sun" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-slate-300" d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.413-1.414zM14 7h2v2h-2zM12.95 14.433l-1.414-1.413 1.413-1.415 1.415 1.414zM7 14h2v2H7zM2.98 14.364l-1.413-1.415 1.414-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.706 4.463 3.12 3.05 4.535 1.636 3.12z" />
                    <path class="fill-slate-400" d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4Z" />
                </svg>
                <svg class="moon" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-slate-400" d="M6.2 1C3.2 1.8 1 4.6 1 7.9 1 11.8 4.2 15 8.1 15c3.3 0 6-2.2 6.9-5.2C9.7 11.2 4.8 6.3 6.2 1Z" />
                    <path class="fill-slate-500" d="M12.5 5a.625.625 0 0 1-.625-.625 1.252 1.252 0 0 0-1.25-1.25.625.625 0 1 1 0-1.25 1.252 1.252 0 0 0 1.25-1.25.625.625 0 1 1 1.25 0c.001.69.56 1.249 1.25 1.25a.625.625 0 1 1 0 1.25c-.69.001-1.249.56-1.25 1.25A.625.625 0 0 1 12.5 5Z" />
                </svg>
                <span class="sr-only">Switch to light / dark version</span>
            </label>
        </div>
        </nav>
    </header>

    <main class="container mx-auto p-4">
      <h1 class="text-4xl font-bold py-4">Translate</h1>
      <div class="flex gap-4 py-4">
        <select id="from-language" class="bg-[var(--bg-light-clr)] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[200px] p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option selected value="en-US">English</option>
          <option value="ar">داريجة</option>
        </select>
    
        <button id="switch-language-btn" class="bg-[var(--bg-light-clr)] text-[var(--text-clr)] p-2.5 hover:border-transparent rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 dark:text-white">
          <svg class="icon svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8 10H20L16 6" stroke="#0040dd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M16 14L4 14L8 18" stroke="#0040dd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <select id="to-language" class="bg-[var(--bg-light-clr)] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[200px] p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="en-US">English</option>
          <option selected value="ar">داريجة</option>
        </select>
      </div>
        <section class="flex flex-col lg:flex-row gap-4">
          <div class="w-full lg:w-1/2 relative">
            <div class="absolute bottom-6 right-4 flex flex-row-reverse gap-2">
              <button class="btn btn-icon" id="from_speaker">
                <svg class="icon svg fill speaker" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13.0355 8.52113C13.4261 8.1306 14.0674 8.12674 14.3881 8.57637C15.0882 9.55788 15.5 10.7592 15.5 12.0567C15.5 13.3541 15.0882 14.5554 14.3881 15.537C14.0674 15.9866 13.4261 15.9827 13.0355 15.5922C12.645 15.2017 12.6586 14.5725 12.9408 14.0978C13.296 13.5002 13.5 12.8023 13.5 12.0567C13.5 11.3111 13.296 10.6131 12.9408 10.0156C12.6586 9.54084 12.645 8.91165 13.0355 8.52113Z" fill="#000000"/>
                  <path d="M15.864 5.69316C16.2545 5.30263 16.8921 5.29976 17.2419 5.72712C18.6532 7.45118 19.5 9.65526 19.5 12.0571C19.5 14.459 18.6532 16.6631 17.2419 18.3871C16.8921 18.8145 16.2545 18.8116 15.864 18.4211C15.4734 18.0306 15.4792 17.4007 15.8183 16.9648C16.8723 15.6098 17.5 13.9068 17.5 12.0571C17.5 10.2075 16.8723 8.50445 15.8183 7.14944C15.4792 6.71351 15.4734 6.08368 15.864 5.69316Z" fill="#000000"/>
                  <path d="M11 16.5858V7.41421C11 6.52331 9.92286 6.07714 9.29289 6.70711L7.29289 8.70711C7.10536 8.89464 6.851 9 6.58579 9H5C4.44772 9 4 9.44772 4 10V14C4 14.5523 4.44772 15 5 15H6.58579C6.851 15 7.10536 15.1054 7.29289 15.2929L9.29289 17.2929C9.92286 17.9229 11 17.4767 11 16.5858Z" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </button>
              <button class="btn btn-icon" id="from_mic">
                <svg class="icon svg stroke mic" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19 10V12C19 15.866 15.866 19 12 19M5 10V12C5 15.866 8.13401 19 12 19M12 19V22M8 22H16M12 15C10.3431 15 9 13.6569 9 12V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V12C15 13.6569 13.6569 15 12 15Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </button>
            </div>
            <textarea name="english" id="from_translate" cols="30" rows="7" class="w-full bg-[var(--bg-light-clr)] p-4 border border-gray-200 rounded-xl text-2xl" placeholder="Enter English text"></textarea>
          </div>
          <div class="w-full lg:w-1/2 relative">
            <div class="absolute bottom-6 right-4 flex flex-row-reverse gap-2">
              <button class="btn btn-icon speaker" id="to_speaker">
                <svg class="icon svg fill speaker" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.0355 8.52113C13.4261 8.1306 14.0674 8.12674 14.3881 8.57637C15.0882 9.55788 15.5 10.7592 15.5 12.0567C15.5 13.3541 15.0882 14.5554 14.3881 15.537C14.0674 15.9866 13.4261 15.9827 13.0355 15.5922C12.645 15.2017 12.6586 14.5725 12.9408 14.0978C13.296 13.5002 13.5 12.8023 13.5 12.0567C13.5 11.3111 13.296 10.6131 12.9408 10.0156C12.6586 9.54084 12.645 8.91165 13.0355 8.52113Z" fill="#000000"/>
                <path d="M15.864 5.69316C16.2545 5.30263 16.8921 5.29976 17.2419 5.72712C18.6532 7.45118 19.5 9.65526 19.5 12.0571C19.5 14.459 18.6532 16.6631 17.2419 18.3871C16.8921 18.8145 16.2545 18.8116 15.864 18.4211C15.4734 18.0306 15.4792 17.4007 15.8183 16.9648C16.8723 15.6098 17.5 13.9068 17.5 12.0571C17.5 10.2075 16.8723 8.50445 15.8183 7.14944C15.4792 6.71351 15.4734 6.08368 15.864 5.69316Z" fill="#000000"/>
                <path d="M11 16.5858V7.41421C11 6.52331 9.92286 6.07714 9.29289 6.70711L7.29289 8.70711C7.10536 8.89464 6.851 9 6.58579 9H5C4.44772 9 4 9.44772 4 10V14C4 14.5523 4.44772 15 5 15H6.58579C6.851 15 7.10536 15.1054 7.29289 15.2929L9.29289 17.2929C9.92286 17.9229 11 17.4767 11 16.5858Z" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </button>
              <button class="btn btn-icon speaker" id="copy">
                <svg class="icon svg fill speaker" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M15 1.25H10.9436C9.10583 1.24998 7.65019 1.24997 6.51098 1.40314C5.33856 1.56076 4.38961 1.89288 3.64124 2.64124C2.89288 3.38961 2.56076 4.33856 2.40314 5.51098C2.24997 6.65019 2.24998 8.10582 2.25 9.94357V16C2.25 17.8722 3.62205 19.424 5.41551 19.7047C5.55348 20.4687 5.81753 21.1208 6.34835 21.6517C6.95027 22.2536 7.70814 22.5125 8.60825 22.6335C9.47522 22.75 10.5775 22.75 11.9451 22.75H15.0549C16.4225 22.75 17.5248 22.75 18.3918 22.6335C19.2919 22.5125 20.0497 22.2536 20.6517 21.6517C21.2536 21.0497 21.5125 20.2919 21.6335 19.3918C21.75 18.5248 21.75 17.4225 21.75 16.0549V10.9451C21.75 9.57754 21.75 8.47522 21.6335 7.60825C21.5125 6.70814 21.2536 5.95027 20.6517 5.34835C20.1208 4.81753 19.4687 4.55348 18.7047 4.41551C18.424 2.62205 16.8722 1.25 15 1.25ZM17.1293 4.27117C16.8265 3.38623 15.9876 2.75 15 2.75H11C9.09318 2.75 7.73851 2.75159 6.71085 2.88976C5.70476 3.02502 5.12511 3.27869 4.7019 3.7019C4.27869 4.12511 4.02502 4.70476 3.88976 5.71085C3.75159 6.73851 3.75 8.09318 3.75 10V16C3.75 16.9876 4.38624 17.8265 5.27117 18.1293C5.24998 17.5194 5.24999 16.8297 5.25 16.0549V10.9451C5.24998 9.57754 5.24996 8.47522 5.36652 7.60825C5.48754 6.70814 5.74643 5.95027 6.34835 5.34835C6.95027 4.74643 7.70814 4.48754 8.60825 4.36652C9.47522 4.24996 10.5775 4.24998 11.9451 4.25H15.0549C15.8297 4.24999 16.5194 4.24998 17.1293 4.27117ZM7.40901 6.40901C7.68577 6.13225 8.07435 5.9518 8.80812 5.85315C9.56347 5.75159 10.5646 5.75 12 5.75H15C16.4354 5.75 17.4365 5.75159 18.1919 5.85315C18.9257 5.9518 19.3142 6.13225 19.591 6.40901C19.8678 6.68577 20.0482 7.07435 20.1469 7.80812C20.2484 8.56347 20.25 9.56458 20.25 11V16C20.25 17.4354 20.2484 18.4365 20.1469 19.1919C20.0482 19.9257 19.8678 20.3142 19.591 20.591C19.3142 20.8678 18.9257 21.0482 18.1919 21.1469C17.4365 21.2484 16.4354 21.25 15 21.25H12C10.5646 21.25 9.56347 21.2484 8.80812 21.1469C8.07435 21.0482 7.68577 20.8678 7.40901 20.591C7.13225 20.3142 6.9518 19.9257 6.85315 19.1919C6.75159 18.4365 6.75 17.4354 6.75 16V11C6.75 9.56458 6.75159 8.56347 6.85315 7.80812C6.9518 7.07435 7.13225 6.68577 7.40901 6.40901Z" fill="#3d3d3d"></path> </g></svg>
              </button>
            </div>
            <textarea name="darija" id="to_translate" cols="30" rows="7" class="w-full p-4 border border-gray-200 rounded-xl text-2xl bg-[var(--bg-light-clr)]" placeholder="Darija translation" readonly></textarea>
          </div>
      </section>
    </main>
  </body>
</html>

