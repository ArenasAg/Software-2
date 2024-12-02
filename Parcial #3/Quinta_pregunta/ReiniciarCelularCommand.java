package Quinta_pregunta;

public class ReiniciarCelularCommand implements Command {
    private Celular celular;

    public ReiniciarCelularCommand(Celular celular) {
        this.celular = celular;
    }

    @Override
    public void execute() {
        celular.reiniciar();
    }
}