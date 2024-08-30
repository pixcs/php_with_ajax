<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Phonebook</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="https://kit.fontawesome.com/b1c58f2092.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-800 mt-[180px] text-white flex item-center justify-center">
    <main class="relative w-[1080px]">
        <h1 class="text-center text-5xl font-bold bg-gradient-to-r from-blue-600 via-green-500 to-white text-transparent bg-clip-text">Phonebook</h1>
        <div id="main-header" class="flex justify-between items-center">
            <button id="add-new-contact-btn" class="bg-blue-500 px-4 py-2 rounded-full  hover:bg-blue-400 hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-plus"></i>
                Add New Contact
            </button>
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-2 top-3 text-gray-400"></i>
                <input id="search-input" type="text" placeholder="Search" class="text-gray-600 font-bold px-4 py-2 rounded-md outline-none ring-4 focus:ring-blue-500 transition-all duration-200 indent-4">
            </div>
        </div>

        <?php require("modal/addModal.php") ?>
        <?php require("modal/updateModal.php") ?>
        <?php require("modal/deleteModal.php") ?>

        <table id="table" class="mt-10">
            <thead id="thead">
                <tr class="tr-head border-2 border-slate-500 text-white">
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody id="tbody"></tbody>
        </table>
        <h2 id="search-label" class="text-center text-2xl font-bold mt-10 w-full"></h2>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="index.js"></script>
</body>
</html>