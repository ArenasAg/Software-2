package Quinta_pregunta;

public class SuspenderCelularCommand implements Command {
    private Celular celular;

    public SuspenderCelularCommand(Celular celular) {
        this.celular = celular;
    }

    @Override
    public void execute() {
        celular.suspender();
    }
}