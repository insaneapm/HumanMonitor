using Constellation;
using Constellation.Package;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace bat
{
    public class Program1 : PackageBase
    {

        [StateObjectLink("BATZOO/BatteryChecker", "072FC7273F933271B97783B73ED696A39A17F4DD")]
        public StateObjectNotifier bat1 { get; set; }
        static void Main(string[] args)
        {
            PackageHost.Start<Program1>(args);
        }

        public override void OnStart()
        {
            PackageHost.WriteInfo("Package starting - IsRunning: {0} - IsConnected: {1}", PackageHost.IsRunning, PackageHost.IsConnected);
            PackageHost.WriteInfo("Batterie : {0} %", this.bat1.DynamicValue.EstimatedChargeRemaining);

        }
    }
}
