using Constellation;
using Constellation.Package;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace warningBattery
{
    public class Program : PackageBase
    {
        [StateObjectLink("BatteryChecker", "072FC7273F933271B97783B73ED696A39A17F4DD")]
        public StateObjectNotifier Batterie { get; set; }   
        static void Main(string[] args)
        {
            PackageHost.Start<Program>(args);
        }

        public override void OnStart()
        {
            PackageHost.WriteInfo("Package starting - IsRunning: {0} - IsConnected: {1}", PackageHost.IsRunning, PackageHost.IsConnected);
            PackageHost.WriteInfo("Batterie : {0}%", this.Batterie.DynamicValue.EstimatedChargeremaining);
          
        }
        
    }
}
