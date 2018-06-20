using Constellation;
using Constellation.Package;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;

namespace MyBrain
{
    public class Program : PackageBase
    {
        [StateObjectLink("HWMonitor", "/intelcpu/0/temperature/0")] //pour faire ca écrire StateObject + Tab + Tab
        public StateObjectNotifier Temperature1 { get; set; }       
        static void Main(string[] args)
        {
            PackageHost.Start<Program>(args);
        }

        public override void OnStart()
        {
           
                PackageHost.WriteInfo("Package starting - IsRunning: {0} - IsConnected: {1}", PackageHost.IsRunning, PackageHost.IsConnected);
                this.Temperature1.ValueChanged += Temperature1_ValueChanged;
                // Temperature1.ValueChanged += Temperature_ValueChanged; // écrire this.temperature.ValueChanged += et Tab Tab
            }
        

        private void Temperature1_ValueChanged(object sender, StateObjectChangedEventArgs e)
        {
            PackageHost.WriteInfo("La température de ton CPU est de {0} °C", this.Temperature1.DynamicValue.Value);
        }
    }
}
