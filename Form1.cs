using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using CookComputing.XmlRpc;

namespace XmlRpcClient
{
    [XmlRpcUrl("http://demoservice/server.php")]
    public interface IDemoServiceProxy:IXmlRpcProxy
    {
        [XmlRpcMethod("demoservice::helloservice_2")]
        string HelloService(HelloServiceArgs args);
    }


    public struct HelloServiceArgs
    {
        public string name;
        public int age;
        public string[] skills;
    }
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            HelloServiceArgs args = new HelloServiceArgs();
            args.name = tb_Name.Text;
            args.age = Convert.ToInt32(tb_Age.Text);
            args.skills= new string[] {"C","Basic" };

            IDemoServiceProxy proxy = XmlRpcProxyGen.Create<IDemoServiceProxy>();

            try
            {
                lb_Result.Text = proxy.HelloService(args);
            }
            catch(XmlRpcException ex)
            {
                MessageBox.Show("XmlRpcException!");
            }
            catch(XmlRpcFaultException ex)
            {
                MessageBox.Show(ex.FaultCode+" "+ex.FaultString);
            }
        }
    }
}
