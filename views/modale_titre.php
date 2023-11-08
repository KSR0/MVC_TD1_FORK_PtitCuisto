<div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="lg:pl-80 modal2 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div id="modal2-test" class="modal2-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>                                
    <div class="modal2-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        
        <div class="modal2-content py-4 text-left px-6">
            
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Filtre par titre</p>
                
                <div class="modal2-close cursor-pointer z-50">
                    <button onclick="activer_sous_menu(); activer_sous_menu_deroulant(); activer_bouton_mobile(); activer_logo_menu(); fond_fonce(); fond_fonce_deroulant()">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            
            <div class="relative">
                <input type="text" id="recette" name="recette" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Saisissiez un titre" required>
                <a id="lien_recette" href="index.php?action=liste_recette&titre=">
                    <button class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Rechercher</button>
                </a>
            </div><br>
            <div id="resultat">
            </div>
            <script>

                $(document).ready(function () {

                    $("#recette").keyup(function () {
                        let saisie = $(this).val();
                        if (saisie.length >= 1) {
                            $.ajax({
                                url: "views/bdd_autocompletion.php?saisie=" + saisie,
                                method: "GET",
                                success: function (data) {
                                    $("#resultat").html(data);
                                }
                            });
                        }
                        else {
                            $("#resultat").empty();
                        }

                        $("#resultat").on("change", "#resultat_texte", function () {
                            let selectedValue = $(this).val();
                            let link = "index.php?action=liste_recette&titre=" + selectedValue;
                            $("#lien_recette").attr("href", link);
                        });
                }); 
            });
            </script>
            <script>
                $(document).ready(function () {
                    $("#recette").keyup(function () {
                        let saisie = $(this).val();
                        let divRecettes = document.querySelector('#resultat');
                        if (saisie.length >= 1) {

                        };
                        let recettes = <?php echo json_encode($recettes) ?>;
                        let content = '';
                        array.forEach(recettes => {
                            $("#resultat").innerHTML = recettes.rec_nom;
                        });
                        divRecettes.innerHTML += content;
                    });
                });
            </script>
        </div>
    </div>
</div>