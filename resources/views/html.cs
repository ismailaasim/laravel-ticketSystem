using System.Collections.Generic;
namespace LINQDemo
{

    public class Employee 
    {
        public int ID {get;set;}
        public string FirstName {get;set;}
        public string LastName {get;set;}
        public int Salary {get;set;}

        public static List<Employee> GetEmployees()
        {
            List<Employee> employees = new List<Employee> {
                new Employee {ID = "101",FirstName = "Praveen1",LastName = "Kumar1",Salary = 30000},
                new Employee {ID = "102",FirstName = "Praveen2",LastName = "Kumar2",Salary = 30000},
                new Employee {ID = "103",FirstName = "Praveen3",LastName = "Kumar3",Salary = 30000},
                new Employee {ID = "104",FirstName = "Praveen4",LastName = "Kumar4",Salary = 30000},
            }
        }
    }



}