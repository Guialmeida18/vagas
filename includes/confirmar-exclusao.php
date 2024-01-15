<main>
    <h2 class="mt-3">excluir vaga</h2>

    <form method="post">
        <div class="form-group">

            <p>voce deseja realmente excluir <strong><?=$obVaga->titulo?></strong>?</p>
        <div class="form-group">
            <section>
                <a href="index.php"
                <button type="button" class="btn btn-success">Cancelar</button>
                </a>
            </section>
            <button type="submit" name="excluir" class="btn btn-danger">excluir</button>
        </div>
    </form>
</main>