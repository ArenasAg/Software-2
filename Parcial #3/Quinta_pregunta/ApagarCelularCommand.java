package Quinta_pregunta;

public class ApagarCelularCommand implements Command {
    private Celular celular;

    public ApagarCelularCommand(Celular celular) {
        this.celular = celular;
    }

    @Override
    public void execute() {
        celular.apagar();
    }
}
