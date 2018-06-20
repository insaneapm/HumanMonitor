using Constellation;
using Constellation.Package;
using MyFirstPackage;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace MyfirstPackage
{
    public class PremierProg : PackageBase
    {
        static void Main(string[] args)
        {
            PackageHost.Start<PremierProg>(args);
        }

        public override void OnStart()
        {       PackageHost.WriteInfo("Je suis le package nommé {0} version {1}", PackageHost.PackageName, PackageHost.PackageVersion);
                PackageHost.WriteInfo("Package starting - IsRunning: {0} - IsConnected: {1}", PackageHost.IsRunning, PackageHost.IsConnected);
                PackageHost.WriteWarn("Y'a un enculé a ta droite !");
                Random rnd = new Random();
            while (PackageHost.IsRunning)
            {
                PackageHost.PushStateObject("Temperature", rnd.Next(30));
                Thread.Sleep(PackageHost.GetSettingValue<int>("Intervalle"));

            }
        }
        /// <summary>
        /// 
        /// </summary>
        /// <param name="frequency">frequece en Hz</param>
        /// <param name="duree">durée en ms</param>
    [MessageCallback]
    public void BeepBeep(int frequency, int duree)
        {
            Console.Beep(frequency,duree );
        }
        [MessageCallback]
    public int Addition(int a ,int b)
        {
            return a + b;
        }
    }
}
