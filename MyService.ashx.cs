using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using CookComputing.XmlRpc;

namespace MyXmlRpcApplication
{
    /// <summary>
    /// Сводное описание для MyService
    /// </summary>
    public class MyService : XmlRpcService
    {
        [XmlRpcMethod("myservice::helloworld",Description ="Метод, выводящий приветствие")]
        public string HelloWorld()
        {
            return "Hello, world!";
        } 
        
        [XmlRpcMethod("myservice::cities")]
        public string Cities(int city_id)
        {
            Dictionary<int, string> cities = new Dictionary<int, string>();

            cities.Add(74, "Челябинск");
            cities.Add(96, "Екатеринбург");
            cities.Add(77, "Москва");

            if (!cities.ContainsKey(city_id))
                throw new XmlRpcFaultException(100,"Город с таким кодом не найден");


            return cities[city_id];
        }
    }
}