<?php
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <script src="tailwind.js"></script>
        <title>Generator Kelompok by zaltechdev</title>
        <style>
            tr:nth-child(2) > td{
                font-weight: bold;
                text-decoration: underline;
            }
        </style>
    </head>
    <body class="w-full h-[100dvh] bg-slate-200 bg-fixed bg-center bg-cover bg-no-repeat bg-[url(./background.jpg)]">
        <div class="bg-black bg-opacity-70 backdrop-blur-sm w-full h-full flex flex-col items-center gap-10">
            <p class="text-center text-xl sm:text-2xl text-white font-bold mt-10">Generator Anggota Kelompok</p>
            <form method="POST" action="/" class="bg-white text-white rounded-md ring-1 ring-slate-500 p-5 bg-opacity-30 backdrop-blur-sm sm:w-96 w-[calc(100%_-_32px)] gap-4 flex flex-col">
                <p>Masukkan nama yang akan dibuat kelompok dan banyak kelompok yang akan dibentuk</p>
                <input type="number" name="groups" class="w-full rounded ring-1 bg-transparent ring-slate-400 h-10 px-4" placeholder="Masukkan banyak kelompok" value="<?php if(isset($_POST['groups'])) { echo htmlspecialchars($_POST['groups']); }?>">
                <textarea name="pool" cols="30" rows="10" class="max-h-52 w-full rounded ring-1 bg-transparent ring-slate-400 p-4" placeholder="Masukkan nama-nama"><?php if(isset($_POST['pool'])) { echo htmlspecialchars($_POST['pool']); }?></textarea>
                <button class="w-full h-10 bg-blue-500 text-white rounded">Buat</button>
            </form>
            <div class="flex flex-col mt-5 items-center justify-center gap-4">
                <div class="flex flex-row items-center gap-4 text-slate-300">
                    <a href="https://instagram.com/zaltechdev" class="flex flex-col items-center justify-center">
                        <p class="fab fa-instagram text-xl"></p>
                        <p class="text-sm">Instagram</p>
                    </a>
                    <a href="https://t.me/zaltechdev" class="flex flex-col items-center justify-center">
                        <p class="fab fa-telegram text-xl"></p>
                        <p class="text-sm">Telegram</p>
                    </a>
                    <a href="https://trakteer.id/zaltechdev/tip" class="flex flex-col items-center justify-center">
                        <p class="fas fa-heart text-xl"></p>
                        <p class="text-sm">Terimakasih</p>
                    </a>
                </div>
                <p class="text-slate-300 text-xs">&copy;Copyrights by zaltechdev 2024 - All rights reserved</p>
            </div>
        </di>
        <?php if(isset($_POST['pool']) && isset($_POST['groups'])) : ?>
            <?php
                $groups_nominal = intval(htmlspecialchars($_POST['groups']));
                    
                $people_name = explode("\n", trim(htmlspecialchars($_POST['pool'])));
                $people_name = array_map("trim",$people_name);
                $people_name = array_filter($people_name);
                shuffle($people_name);

                $groups = array_fill(0, $groups_nominal, []);
                
                $index = 0;
                foreach($people_name as $name){
                    $groups[$index][] = $name;
                    $index = ($index + 1) % $groups_nominal;
                }
            ?>
            <aside class="bg-black bg-opacity-70 backdrop-blur-sm w-full h-full flex flex-col items-center fixed top-0 left-0">
                <div class="bg-white text-white rounded-md ring-1 ring-slate-500 p-5 bg-opacity-30 backdrop-blur-sm sm:w-2/3 w-full h-full gap-4 grid grid-cols-2 sm:grid-cols-3 sm:mt-10 overflow-auto">
                    <?php if(isset($groups)) : ?>
                        <?php for($i = 0; $i < count($groups); $i ++) : ?>
                            <table class="ring-1 ring-slate-400 rounded w-full shrink-0 h-max">
                                <tr>
                                    <th class="text-left italic p-1 border-0 border-solid border-slate-400 border-b-[1px]">Kelompok <?=$i+1?></th>
                                </tr>
                                <?php foreach($groups[$i] as $people) : ?>
                                <tr>
                                    <td class="p-1"><?=ucfirst(htmlspecialchars($people))?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-row gap-4 items-center min-w-full h-20 justify-center">
                    <button onclick="document.querySelector('aside').remove()" class="bg-red-500 text-white px-4 py-2 rounded">Buang</button>
                    <button onclick="window.location.reload()" class="bg-blue-500 text-white px-4 py-2 rounded">Acak</button>
                    <button onclick="window.print()" class="bg-emerald-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </aside>
        <?php endif; ?>
    </body>
</html>