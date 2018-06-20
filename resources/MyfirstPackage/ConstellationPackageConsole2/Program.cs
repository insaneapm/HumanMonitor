using Constellation;
using Constellation.Package;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ConstellationPackageConsole2
{
    public class Program : PackageBase
    {

        [StateObjectLink("HWMonitor", "/intelcpu/0/temperature/0")]
        public StateObjectNotifier TemperatureCPU { get; set; }
        static void Main(string[] args)
        {
            PackageHost.Start<Program>(args);
        }

        public override void OnStart()
        {
            PackageHost.WriteInfo("Package starting - IsRunning: {0} - IsConnected: {1}", PackageHost.IsRunning, PackageHost.IsConnected);
            PackageHost.WriteInfo("La T° de ton CPU est {0} °C" , TemperatureCPU.DynamicValue.Value);
        }
    }
}
