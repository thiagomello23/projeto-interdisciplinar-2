<?php
    include_once("templates/header.php");
?>

    <section id="register">
        <div>
        <div class="alert alert-danger hidden" role="alert" id="alertDiv">
            <span id="alertMsg"></span>
        </div>
            <form id="form--register">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" class="form-control" id="nameRegister" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="emailRegister" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" name="password" id="passwordRegister" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirme sua senha:</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPasswordRegister" required>
                </div>
                <button type="submit" class="btn btn-dark btn--registro" id="registerSubmit">Registro</button>
            </form>
        </div>
    </section>

    <script src="script/registro.js"></script>

<?php
    include_once("templates/footer.php");
?>