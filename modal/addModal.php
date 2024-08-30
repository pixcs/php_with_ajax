<div id="add-form" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="fixed inset-0 bg-zinc-950 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <form action="action/insert.php" id="add-new-contact-form" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">

                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-xl font-bold leading-6 text-green-600" id="modal-title">
                                <i class="fa-solid fa-user-plus"></i>
                                Add New Contact
                            </h3>
                            <div class="mt-2 flex flex-col gap-2">
                                <div class="flex items-center space-x-4">
                                    <label for="name" class="text-black w-[55px]">Name</label>
                                    <input type="text" placeholder="Shuryuken" id="name" class="w-full p-2 outline-none text-black ring-1 ring-slate-300 focus:ring-green-500 rounded-md" name="name" required />
                                </div>
                                <div class="flex items-center space-x-4">
                                    <label for="phone" class="text-black w-[50px]">Phone</label>
                                    <input type="tel" placeholder="01234567891" pattern="[0-9]{11}" maxlength="11" id="phone" class="w-full p-2 outline-none text-black ring-1 ring-slate-300 focus:ring-green-500 rounded-md" name="phone" required />
                                </div>
                                <div class="flex items-center space-x-4">
                                    <label for="email" class="text-black w-[50px]">Email</label>
                                    <input type="email" placeholder="shuryuken@gmail.com" id="email" class="w-full p-2 outline-none text-black ring-1 ring-slate-300 focus:ring-green-500 rounded-md" name="email" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button id="submit-btn" type="submit" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Submit</button>
                    <button id="cancel-btn" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>