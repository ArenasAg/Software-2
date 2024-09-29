class Employee{
    private String name;
    private int id;
    private Double salary;

    public Employee(String name, int id, Double salary){
        this.name = name;
        this.id = id;
        this.salary = salary;
    }

    public String name(){
        return name;
    }

    public int id(){
        return id;
    }

    public Double salary(){
        return salary;
    }
}

class EmployeeService{
    public void printEmployee(Employee employee){
        System.out.println("Employee:");
        System.out.println("Name: " + employee.name());
        System.out.println("ID: " + employee.id());
        System.out.println("Salary: " + employee.salary());
    }
}

interface BonusCalculator{
    Double calculateBonus(Employee employee);
}

class FullTimeEmployee implements BonusCalculator{
    @Override
    public Double calculateBonus(Employee employee){
        return employee.salary() * 0.2;
    }
}

class PartTimeEmployee implements BonusCalculator{
    @Override
    public Double calculateBonus(Employee employee){
        return employee.salary() * 0.1;
    }
}

class Contractor implements BonusCalculator{
    @Override
    public Double calculateBonus(Employee employee){
        return employee.salary() * 0.05;
    }
}

class BonusService{
    private BonusCalculator bonusCalculator;

    public BonusService(BonusCalculator bonusCalculator){
        this.bonusCalculator = bonusCalculator;
    }

    public void service(Employee employee){
        EmployeeService employeeService = new EmployeeService();
        employeeService.printEmployee(employee);
        System.out.println("Bonus: " + bonusCalculator.calculateBonus(employee));

    }
}



public class Ejercicio {    
    public static void main(String[] args) {
        Employee employee = new Employee("Anderson", 1, 2000.0);

        BonusCalculator bonusCalculator = new FullTimeEmployee();
        BonusService bonusService = new BonusService(bonusCalculator);
        bonusService.service(employee);
    }
}